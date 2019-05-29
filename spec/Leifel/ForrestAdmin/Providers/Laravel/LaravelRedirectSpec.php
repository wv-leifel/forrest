<?php

namespace spec\Leifel\ForrestAdmin\Providers\Laravel;

use Illuminate\Routing\Redirector;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LaravelRedirectSpec extends ObjectBehavior
{
    public function let(Redirector $redirector)
    {
        $this->beConstructedWith($redirector);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Leifel\ForrestAdmin\Providers\Laravel\LaravelRedirect');
    }

    public function it_should_allow_a_redirect(Redirector $redirector)
    {
        $redirector->to('wubbadubbadubdub')->shouldBeCalled();
        $this->to('wubbadubbadubdub');
    }
}
