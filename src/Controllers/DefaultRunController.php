<?php

namespace AssistantEngine\AgentLoop\Controllers;

use AssistantEngine\AgentLoop\Contracts\AbstractRunController;
use AssistantEngine\OpenFunctions\Core\Contracts\Providers\ProviderResponse;
use AssistantEngine\OpenFunctions\Core\Contracts\Responses\ComputerResponseItem;
use AssistantEngine\OpenFunctions\Core\Contracts\Types\Item;
use AssistantEngine\OpenFunctions\Core\Responses\OpenFunctionResponse;
use AssistantEngine\OpenFunctions\Core\Types\ComputerCall;
use AssistantEngine\OpenFunctions\Core\Types\ComputerCallOutput;
use AssistantEngine\OpenFunctions\Core\Types\FunctionCall;
use AssistantEngine\OpenFunctions\Core\Types\FunctionCallOutput;
use AssistantEngine\AgentLoop\Contracts\LoopInterface;

class DefaultRunController extends AbstractRunController
{
    public function onItemCreation(
        Item $newItem,
        LoopInterface $loop,
        ProviderResponse $response
    ): void {
        // Add the new assistant message to the list.
        $loop->addItem($newItem);
    }

    public function onFunctionCallFinished(
        FunctionCall         $functionCall,
        OpenFunctionResponse $functionResponse,
        LoopInterface        $loop,
        ProviderResponse     $response
    ): void {
        $functionCallOutput = new FunctionCallOutput($functionCall->callId, $functionResponse->getOutput());
        // Add the tool message to the list.
        $loop->addItem($functionCall);
        $loop->addItem($functionCallOutput);
    }

    public function onComputerCallFinished(
        ComputerCall $computerCall,
        ComputerResponseItem $computerResponseItem,
        LoopInterface $loop,
        ProviderResponse $response
    ): void {
        $computerCallOutput = ComputerCallOutput::make($computerCall->callId, $computerResponseItem);
        // Add the tool message to the list.
        $loop->addItem($computerCall);
        $loop->addItem($computerCallOutput);
    }

    public function shouldLoopStop(int $iteration, LoopInterface $loop, ProviderResponse $response): bool
    {
        // If the finish reason is not tool calls
        if ($response->getFinishReason() !== ProviderResponse::FINISH_REASON_TOOL_CALLS) {
            return true;
        }

        return false;
    }
}