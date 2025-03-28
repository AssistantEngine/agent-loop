<?php

namespace AssistantEngine\AgentLoop\Contracts;

use AssistantEngine\OpenFunctions\Core\Contracts\Providers\ProviderResponse;
use AssistantEngine\OpenFunctions\Core\Contracts\Responses\ComputerResponseItem;
use AssistantEngine\OpenFunctions\Core\Contracts\Types\Item;
use AssistantEngine\OpenFunctions\Core\Responses\OpenFunctionResponse;
use AssistantEngine\OpenFunctions\Core\Types\ComputerCall;
use AssistantEngine\OpenFunctions\Core\Types\FunctionCall;

class AbstractEventProcessor implements EventProcessorInterface
{
    public function onRunStart(): void {}

    public function onLoopStart(LoopInterface $loop): void {}

    public function onRunStepStart(LoopInterface $loop, int $iteration): void {}

    public function onBeforeProviderRequest(array $payload): void {}

    public function onItemCreation(
        Item $newItem,
        LoopInterface $loop,
        ProviderResponse $response
    ): void {}

    public function onFunctionCall(
        FunctionCall $functionCall,
        LoopInterface $loop,
        ProviderResponse $response
    ): void {}

    public function onFunctionCallFinished(
        FunctionCall         $functionCall,
        OpenFunctionResponse $functionResponse,
        LoopInterface        $loop,
        ProviderResponse     $response
    ): void {}

    public function onComputerCall(
        ComputerCall $computerCall,
        LoopInterface $loop,
        ProviderResponse $response
    ): void {}

    public function onComputerCallFinished(
        ComputerCall $computerCall,
        ComputerResponseItem $computerResponseItem,
        LoopInterface $loop,
        ProviderResponse $response
    ): void {}

    public function onRunStepFinished(LoopInterface $loop, ProviderResponse $response): void {}

    public function onLoopFinished(LoopInterface $loop, string $loopRunFinishReason): void {}

    public function onRunFinished(LoopInterface $loop, string $runFinishReason): void {}

    public function onError(\Throwable $exception): void {}
}