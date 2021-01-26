<?php
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class BaseServiceMakeCommand extends GeneratorCommand
{
    /**
     * O nome e a assinatura do comando do console.
     *
     * @var string
     */
    protected $name = 'make:base-service';
  
    /**
      * A descrição do comando do console.
      *
      * @var string
      */
    protected $description = 'Create a new base service class';
  
    /**
     * O tipo de classe sendo gerada.
     *
     * @var string
     */
    protected $type = 'Service';

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
        return $stub;
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
        return  base_path() . '/stubs/base-service.stub';
    }
    /**
   * Obtém o namespace padrão para a classe.
   *
   * @param  string  $rootNamespace
   * @return string
   */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }

    /**
     * Obtém os argumentos do comando do console.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the service.'],
        ];
    }
}
