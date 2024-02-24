<?php

namespace HiEvents\Http\Actions\Organizers;

use Symfony\Component\HttpFoundation\Response;
use HiEvents\DomainObjects\ImageDomainObject;
use HiEvents\DomainObjects\OrganizerDomainObject;
use HiEvents\Http\Actions\BaseAction;
use HiEvents\Repository\Interfaces\OrganizerRepositoryInterface;
use HiEvents\Resources\Organizer\OrganizerResource;

class GetOrganizerAction extends BaseAction
{
    public function __construct(private readonly OrganizerRepositoryInterface $organizerRepository)
    {
    }

    public function __invoke(int $organizerId): Response
    {
        $this->isActionAuthorized(
            entityId: $organizerId,
            entityType: OrganizerDomainObject::class,
        );

        $organizer = $this->organizerRepository
            ->loadRelation(ImageDomainObject::class)
            ->findFirstWhere([
                'id' => $organizerId,
                'account_id' => $this->getAuthenticatedUser()->getAccountId()
            ]);

        if ($organizer === null) {
            return $this->notFoundResponse();
        }

        return $this->resourceResponse(
            resource: OrganizerResource::class,
            data: $organizer,
        );
    }
}
