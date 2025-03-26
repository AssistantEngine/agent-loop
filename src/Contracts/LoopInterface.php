<?php

namespace AssistantEngine\AgentLoop\Contracts;


use AssistantEngine\OpenFunctions\Core\Contracts\AbstractOpenFunction;
use AssistantEngine\OpenFunctions\Core\Contracts\List\ItemListFilterInterface;
use AssistantEngine\OpenFunctions\Core\Contracts\List\ItemListPresenter;
use AssistantEngine\OpenFunctions\Core\Contracts\Providers\ProviderInterface;
use AssistantEngine\OpenFunctions\Core\Contracts\Types\Item;
use AssistantEngine\OpenFunctions\Core\List\ItemList;

interface LoopInterface
{
    public function getIdentifier(): string;
    public function getProvider(): ProviderInterface;
    public function getParams(): array;
    public function getItemList(): ItemList;
    public function getOpenFunction(): ?AbstractOpenFunction;
    public function setOpenFunction(?AbstractOpenFunction $openFunction): self;

    /**
     * @return ItemListFilterInterface[]
     */
    public function getFilters(): array;
    public function setFilters(array $filters): self;

    /**
     * @return ItemListPresenter[]
     */
    public function getPresenters(): array;
    public function setPresenters(array $presenters): self;

    public function getMaxIterations(): int;
    public function setMaxIterations(int $maxIterations): self;

    public function getInput(): ?ItemList;
    public function setInput(?ItemList $input): self;

    public function getClearItems(): bool;
    public function clearItems(bool $clearItems): self;

    public function start(): void;

    public function stop(): void;

    public function addItem(Item $item): self;
}