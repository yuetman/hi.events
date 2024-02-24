<?php

namespace HiEvents\Service\Handler\Question;

use Illuminate\Database\DatabaseManager;
use Throwable;
use HiEvents\DomainObjects\Generated\QuestionDomainObjectAbstract;
use HiEvents\DomainObjects\QuestionDomainObject;
use HiEvents\Http\DataTransferObjects\UpsertQuestionDTO;
use HiEvents\Repository\Interfaces\QuestionRepositoryInterface;

readonly class CreateQuestionHandler
{
    public function __construct(
        private QuestionRepositoryInterface $questionRepository,
        private DatabaseManager             $databaseManager)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(UpsertQuestionDTO $createQuestionDTO): QuestionDomainObject
    {
        return $this->databaseManager->transaction(fn() => $this->questionRepository->create([
            QuestionDomainObjectAbstract::TITLE => $createQuestionDTO->title,
            QuestionDomainObjectAbstract::EVENT_ID => $createQuestionDTO->event_id,
            QuestionDomainObjectAbstract::BELONGS_TO => $createQuestionDTO->belongs_to->name,
            QuestionDomainObjectAbstract::TYPE => $createQuestionDTO->type->name,
            QuestionDomainObjectAbstract::REQUIRED => $createQuestionDTO->required,
            QuestionDomainObjectAbstract::OPTIONS => $createQuestionDTO->options,
            QuestionDomainObjectAbstract::IS_HIDDEN => $createQuestionDTO->is_hidden,

        ], $createQuestionDTO->ticket_ids));
    }
}
