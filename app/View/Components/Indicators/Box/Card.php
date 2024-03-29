<?php

namespace App\View\Components\Indicators\Box;

use Illuminate\View\Component;
use Illuminate\Support\{Str, Stringable};

class Card extends Component
{
    public function __construct(
        public ?string $padding = null,
        public ?string $shadow = null,
        public ?string $rounded = null,
        public ?string $border = null,
        public ?string $color = null,
        public ?string $title = null,
        public ?string $action = null,
        public ?string $header = null,
        public ?string $description = null,
        public ?string $count = null,
        public ?string $unit = null,
        public ?string $footer = null,
        public ?string $porc = null,
        public ?string $cardClasses = '',
        public ?string $headerClasses = '',
        public ?string $footerClasses = '',
    ) {
        $padding ??= config('wireui.card.padding');
        $shadow  ??= config('wireui.card.shadow');
        $rounded ??= config('wireui.card.rounded');
        $border ??= config('wireui.card.border');
        $color   ??= config('wireui.card.color');

        $this->padding       = $padding;
        $this->shadow        = $shadow;
        $this->rounded       = $rounded;
        $this->border        = $border;
        $this->color         = $color;
        $this->cardClasses   = $this->setCardClasses($cardClasses);
        $this->headerClasses = $this->setHeaderClasses($headerClasses);
        $this->footerClasses = $this->setFooterClasses($footerClasses);
    }

    public function setCardClasses(?string $cardClasses): string
    {
        return Str::of('w-full flex flex-col')
            ->append(" {$this->shadow}")
            ->append(" {$this->rounded}")
            ->append(" {$this->border}")
            ->append(" {$this->color}")
            ->append(" {$cardClasses}");
    }

    public function setHeaderClasses(?string $headerClasses): string
    {
        if (Str::contains($headerClasses, 'dark:border')) {
            return Str::of('px-1 py-1 flex justify-between items-center border-b dark:border-0')
                ->replace('dark:border-0', '')
                ->append(" {$headerClasses}");
        }
        return Str::of('px-1 py-1 flex justify-between items-center border-b dark:border-0')
            ->append(" {$headerClasses}");
    }

    public function setFooterClasses(?string $footerClasses): string
    {
        return Str::of('px-1 py-1 sm:px-6 bg-secondary-50 rounded-t-none border-t dark:bg-secondary-800 dark:border-secondary-600')
            ->append(" {$this->rounded}")
            ->append(" {$footerClasses}");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.indicators.box.card');
    }
}
