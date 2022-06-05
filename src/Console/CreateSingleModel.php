<?php
namespace Syscape\Single\Console;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class CreateSingleModel extends GeneratorCommand
{
    protected $name = 'single:model';
    protected $description = 'Create new Single Model Class in Single Folder';
    protected $type = "model";

    protected function getStub()
    {
        return __DIR__ . '/stubs/model.stub';
    }
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Singles';
    }

    public function handle()
    {
        $this->printOurFlag();
        parent::handle();

        $this->doOtherOperations();
    }

    protected function doOtherOperations()
    {
        // Get the fully qualified class name (FQN)
        $class = $this->qualifyClass($this->getNameInput());

        // get the destination path, based on the default namespace
        $path = $this->getPath($class);

        $content = file_get_contents($path);

        // Update the file content with additional data (regular expressions)

        file_put_contents($path, $content);
    }
    public function printOurFlag(){
        $this->line('<fg=white;bg=black> #FREE </> <fg=white;bg=red>PALESTINE</><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white> <fg=white;bg=red>       </> </><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white>  <fg=white;bg=red>     </>  </><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white>   <fg=white;bg=red>   </>   </><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white>    <fg=white;bg=red> </>    </><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white>         </><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white>         </><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white>         </><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white>         </><fg=white;bg=green>      </>');
        $this->line('<fg=white;bg=black>       </> <fg=black;bg=white>         </><fg=white;bg=green>      </>');
    }

}
