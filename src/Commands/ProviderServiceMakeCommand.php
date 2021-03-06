<?php
namespace Ducascao\ApiMaker\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class ProviderServiceMakeCommand extends GeneratorCommand
{
    /**
     * O nome e a assinatura do comando do console.
     *
     * @var string
     */
    protected $name = 'make:provider-service';
  
    /**
      * A descrição do comando do console.
      *
      * @var string
      */
    protected $description = 'Create a new provider class';
  
    /**
     * O tipo de classe sendo gerada.
     *
     * @var string
     */
    protected $type = 'Provider';

    /**
    * Substitui o nome da classe para o stub fornecido.
    *
    * @param  string  $stub
    * @param  string  $name
    * @return string
    */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        return str_replace('Dummy', $this->argument('name'), $stub);
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceClass($stub, $name);
    }

    /**
     * Obtpem o arquivo stub para o gerador.
     *
     * @return string
     */
    protected function getStub()
    {
        return  base_path() . '/stubs/provider-service.stub';
    }
    /**
   * Obtém o namespace padrão para a classe.
   *
   * @param  string  $rootNamespace
   * @return string
   */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Providers';
    }

    /**
     * Obtém os argumentos do comando do console.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the provider.'],
        ];
    }
}
