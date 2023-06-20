<?php

namespace ReesMcIvor\ApiAuth\Console\Commands;

use Illuminate\Console\Command;
use ReesMcIvor\ApiAuth\Models\ApiKey;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateApiKeys extends Command {

    protected $name = 'api-auth:create';
    protected $description = 'Create a set of api keys';

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $apiKeys = ApiKey::factory()->create();
        $output->writeln('API Key: ' . $apiKeys->key);
        $output->writeln('API Secret: ' . $apiKeys->secret);
        $output->writeln("Expires at: {$apiKeys->expires_at}");

        return Command::SUCCESS;

    }

}
