<?php

namespace spec\Leifel\ForrestAdmin\Repositories;

use Leifel\ForrestAdmin\Repositories\InstanceURLRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Leifel\ForrestAdmin\Interfaces\RepositoryInterface;

class InstanceURLRepositorySpec extends ObjectBehavior
{
    protected $settings = [];

    function it_is_initializable()
    {
        $this->shouldHaveType(InstanceURLRepository::class);
    }

    public function let(
        RepositoryInterface $mockedTokenRepo)
    {
        $this->beConstructedWith($mockedTokenRepo, $this->settings);

        $mockedTokenRepo->get()->willReturn(['instance_url' => 'tokenInstanceURL']);
    }

    public function it_should_return_when_put(RepositoryInterface $mockedTokenRepo)
    {
        $mockedTokenRepo->get()->shouldBeCalled()->willReturn([]);
        $mockedTokenRepo->put(['instance_url'=>'this'])->shouldBeCalled();
        $this->put('this')->shouldReturn(null);
    }

    public function it_should_return_instance_url_when_setting_is_set(RepositoryInterface $mockedTokenRepo)
    {
        $this->settings['instanceURL'] = 'settingInstanceURL';
        $this->beConstructedWith($mockedTokenRepo, $this->settings);

        $this->get()->shouldReturn('settingInstanceURL');
    }

    public function it_should_return_instance_url_when_setting_is_not_set()
    {
        $this->get()->shouldReturn('tokenInstanceURL');
    }
}
