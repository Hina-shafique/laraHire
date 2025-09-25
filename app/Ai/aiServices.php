<?php

namespace App\Ai;
use Illuminate\Support\Facades\Http;

class AiServices
{
    protected $message;

    public function sendRequest(string $jobDescription)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.proposal_ai.token'),
            'Content-Type' => 'application/json',
        ])->post("https://api-inference.huggingface.co/models/mistralai/Mixtral-8x7B-Instruct-v0.1", [
                    'inputs' => $jobDescription
                ])->json();

        if (isset($response[0]['generated_text'])) {
            $this->message = $response[0]['generated_text'];
            return $this->message;
        }

        return $response;
    }

    public function generateResponse($jobDescription): ?string
    {
        return $this->sendRequest($jobDescription);
    }
}