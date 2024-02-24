<?php

namespace HiEvents\Service\Handler\Event;

use Illuminate\Database\DatabaseManager;
use Throwable;
use HiEvents\DomainObjects\Enums\EventImageType;
use HiEvents\DomainObjects\EventDomainObject;
use HiEvents\DomainObjects\ImageDomainObject;
use HiEvents\Http\DataTransferObjects\CreateEventImageDTO;
use HiEvents\Repository\Interfaces\ImageRepositoryInterface;
use HiEvents\Service\Common\Image\ImageUploadService;

readonly class CreateEventImageHandler
{
    public function __construct(
        private ImageUploadService       $imageUploadService,
        private ImageRepositoryInterface $imageRepository,
        private DatabaseManager          $databaseManager,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(CreateEventImageDTO $imageData): ImageDomainObject
    {
        return $this->databaseManager->transaction(function () use ($imageData) {
            if ($imageData->type === EventImageType::EVENT_COVER) {
                $this->imageRepository->deleteWhere([
                    'entity_id' => $imageData->event_id,
                    'entity_type' => EventDomainObject::class,
                    'type' => EventImageType::EVENT_COVER->name,
                ]);
            }

            return $this->imageUploadService->upload(
                image: $imageData->image,
                entityId: $imageData->event_id,
                entityType: EventDomainObject::class,
                imageType: EventImageType::EVENT_COVER->name,
            );
        });
    }
}
