<?php declare(strict_types=1);

namespace TestPlugin\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Shopware\Core\Framework\Context;
use TestPlugin\Service\CustomFieldsInstaller;

#[AsCommand(
    name: 'swag-commands:import-test',
    description: 'Add a short description for your command',
)]
class ExampleCommand extends Command
{
// Actual code executed in the command
    private CustomFieldsInstaller $customFieldsInstaller;

    public function __construct(CustomFieldsInstaller $customFieldsInstaller)
    {
        parent::__construct();
        $this->customFieldsInstaller = $customFieldsInstaller;
    }

// Provides a description, printed out in bin/console
    protected function configure(): void
    {
        $this->setDescription('Imports products from an external API.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting product import...');

        $context = Context::createDefaultContext();
        $this->customFieldsInstaller->importProducts($context);

        $output->writeln('Product import completed.');

        return 0;
    }


}
