<?php

class Twig_Extension_Ref extends Twig_Extension
{
    function getName()
    {
        return 'php-ref';
    }

    protected function _getFunction()
    {
        return new Twig_Function_Method(
            $this, 'refFunction', array(
                'is_safe' => array('html'),
                'needs_context' => true,
                'needs_environment' => true
            )
        );
    }

    public function getFunctions()
    {
        return array(
            'ref' => $this->_getFunction()
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
        r(2 === func_num_args() ? $context : array_slice(func_get_args(), 2));
        return ob_get_clean();
    }
}
