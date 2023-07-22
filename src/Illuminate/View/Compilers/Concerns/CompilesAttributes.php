<?php

namespace Illuminate\View\Compilers\Concerns;

trait CompilesAttributes
{
    /**
     * Compile the conditional attributes statement into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileAttributes($expression)
    {
        $expression = is_null($expression) ? '([])' : $expression;

        return "<?php echo (fn (\$propOrAttributes, ...\$localAttributes) => match (true) {
            \$propOrAttributes instanceof \Illuminate\View\ComponentAttributeBag => \$propOrAttributes->merge(...\$localAttributes),
            is_array(\$propOrAttributes) && isset(\$attributes) => \$attributes?->merge(\$propOrAttributes),
            is_array(\$localAttributes) && isset(\$attributes) => \$attributes?->merge(...\$localAttributes),
        })$expression; ?>";
    }
}
