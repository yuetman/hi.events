<?php

namespace HiEvents\Service\Common\Payment\Stripe;

use Illuminate\Config\Repository;
use Psr\Log\LoggerInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use HiEvents\Exceptions\Stripe\CreatePaymentIntentFailedException;
use HiEvents\Service\Common\Payment\Stripe\DTOs\CreatePaymentIntentRequestDTO;
use HiEvents\Service\Common\Payment\Stripe\DTOs\CreatePaymentIntentResponseDTO;

readonly class StripePaymentIntentCreationService
{
    public function __construct(
        private StripeClient    $stripeClient,
        private LoggerInterface $logger,
        private Repository      $config,
    )
    {
    }

    /**
     * @throws CreatePaymentIntentFailedException
     */
    public function retrievePaymentIntentClientSecret(
        string  $paymentIntentId,
        ?string $accountId = null,
    ): string
    {
        try {
            return $this->stripeClient->paymentIntents->retrieve(
                id: $paymentIntentId,
                opts: $accountId ? ['stripe_account' => $accountId] : []
            )->client_secret;
        } catch (ApiErrorException $exception) {
            $this->logger->error("Stripe payment intent retrieval failed: {$exception->getMessage()}", [
                'exception' => $exception,
                'paymentIntentId' => $paymentIntentId,
            ]);

            throw new CreatePaymentIntentFailedException(
                __('There was an error communicating with the payment provider. Please try again later.')
            );
        }
    }

    /**
     * @throws CreatePaymentIntentFailedException
     */
    public function createPaymentIntent(CreatePaymentIntentRequestDTO $paymentIntentDTO): CreatePaymentIntentResponseDTO
    {
        try {
            $paymentIntent = $this->stripeClient->paymentIntents->create([
                'amount' => $paymentIntentDTO->amount,
                'currency' => $paymentIntentDTO->currencyCode,
                'setup_future_usage' => 'on_session',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'application_fee_amount' => $this->getApplicationFee($paymentIntentDTO),
            ], $this->getStripeAccountData($paymentIntentDTO));

            $this->logger->debug('Stripe payment intent created', [
                'paymentIntentId' => $paymentIntent->id,
                'paymentIntentDTO' => $paymentIntentDTO->toArray(['account']),
            ]);

            return new CreatePaymentIntentResponseDTO(
                paymentIntentId: $paymentIntent->id,
                clientSecret: $paymentIntent->client_secret,
                accountId: $paymentIntentDTO->account->getStripeAccountId(),
            );
        } catch (ApiErrorException $exception) {
            $this->logger->error("Stripe payment intent creation failed: {$exception->getMessage()}", [
                'exception' => $exception,
                'paymentIntentDTO' => $paymentIntentDTO->toArray(['account']),
            ]);

            throw new CreatePaymentIntentFailedException(
                __('There was an error communicating with the payment provider. Please try again later.')
            );
        }
    }

    private function getApplicationFee(CreatePaymentIntentRequestDTO $paymentIntentDTO): float
    {
        if (!$this->config->get('app.saas_mode_enabled')) {
            return 0;
        }

        return ceil($paymentIntentDTO->amount * $this->config->get('app.saas_stripe_application_fee_percent') / 100);
    }

    private function getStripeAccountData(CreatePaymentIntentRequestDTO $paymentIntentDTO): array
    {
        if ($this->config->get('app.saas_mode_enabled')) {
            return ['stripe_account' => $paymentIntentDTO->account->getStripeAccountId()];
        }

        return [];
    }
}
