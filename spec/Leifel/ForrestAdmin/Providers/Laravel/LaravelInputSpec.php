<?php

namespace spec\Leifel\ForrestAdmin\Providers\Laravel;

use Illuminate\Http\Request;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LaravelInputSpec extends ObjectBehavior
{
    public function let(Request $request)
    {
        $this->beConstructedWith($request);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Leifel\ForrestAdmin\Providers\Laravel\LaravelInput');
    }

    public function it_should_allow_getting_input_from_request(Request $request)
    {
        $request->input('rick')->shouldBeCalled()->willReturn('morty');
        $this->get('rick')->shouldReturn('morty');
    }
}
