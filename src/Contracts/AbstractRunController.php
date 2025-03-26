<?php

namespace AssistantEngine\AgentLoop\Contracts;


use AssistantEngine\OpenFunctions\Core\Contracts\Providers\ProviderResponse;
use AssistantEngine\OpenFunctions\Core\Contracts\Responses\ComputerResponseItem;
use AssistantEngine\OpenFunctions\Core\Contracts\Types\Item;
use AssistantEngine\OpenFunctions\Core\Responses\Response;
use AssistantEngine\OpenFunctions\Core\Types\ComputerCall;
use AssistantEngine\OpenFunctions\Core\Types\FunctionCall;
use AssistantEngine\AgentLoop\Contracts\LoopInterface;

/**
 * A no-operation processor that implements all methods with empty bodies.
 */
abstract class AbstractRunController implements EventProcessorInterface
{
    public function onRunStart(): void {}

    public function onLoopStart(LoopInterface $loop): void {}

    public function onRunStepStart(LoopInterface $loop, int $iteration): void {}

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
         FunctionCall $functionCall,
         Response $functionResponse,
         LoopInterface $loop,
         ProviderResponse $response
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

    abstract public function shouldLoopStop(int $iteration, LoopInterface $loop, ProviderResponse $response): bool;

    public function onLoopFinished(LoopInterface $loop, string $loopRunFinishReason): void {}

    public function shouldCancelRun(LoopInterface $lastLoop): bool
    {
        return false;
    }

    public function onRunFinished(LoopInterface $loop, string $runFinishReason): void {}

    public function onError(\Throwable $exception): void {}
}