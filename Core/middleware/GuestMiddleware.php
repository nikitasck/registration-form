<?php 

namespace app\Core\middleware;
use app\Core\Application;
use app\core\exception\ForbiddenExcepention;

//Принимает действие(action), Проверяет, если пользователь гость(в приложении нет сущности пользователя, а точнее в сесии). Проверяем, пустой ли метод action или если action в приложении совпадает с получаемым методом(что?).

class GuestMiddleware extends BaseMiddleware
{

    public array $actions;

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isGuest()){
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenExcepention();
            }
        }
    }
}

?>