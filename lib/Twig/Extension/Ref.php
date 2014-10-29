<?php

class Twig_Extension_Ref extends Twig_Extension
{
    function getName()
    {
        return 'php-ref';
    }

    protected function _getFunction($name)
    {
        return new Twig_Function_Method(
            $this, $name, array(
                'is_safe' => array('html'),
                'needs_context' => true,
                'needs_environment' => true
            )
        );
    }

    public function getFunctions()
    {
        return array(
            $this->_getFunction('refFunction')
        );
    }

    /**
     * @param Twig_Environment $env
     * @param array $context
     * @return string
     */
    function refFunction(Twig_Environment $env, array $context)
    {
        if (!$env->isDebug()) {
            return '';
        }

        ob_start();

        $count = func_num_args();
        if (2 === $count) {
            $vars = array();
            foreach ($context as $key => $value) {
                if (!$value instanceof Twig_Template) {
                    $vars[$key] = $value;
                }
            }
            r($vars);
        } else {
            for ($i = 2; $i < $count; $i++) {
                r(func_get_arg($i));
            }
        }

        return ob_get_clean();
    }
}
