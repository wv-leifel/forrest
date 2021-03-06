<?php

namespace spec\Leifel\ForrestAdmin\Repositories;

use Leifel\ForrestAdmin\Repositories\TokenRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Leifel\ForrestAdmin\Interfaces\EncryptorInterface;
use Leifel\ForrestAdmin\Interfaces\StorageInterface;
use Leifel\ForrestAdmin\Exceptions\MissingTokenException;

class TokenRepositorySpec extends ObjectBehavior
{

    public function let(EncryptorInterface $mockedEncryptor, StorageInterface $mockedStorage) {
        $this->beConstructedWith($mockedEncryptor, $mockedStorage);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TokenRepository::class);
    }

    function it_should_store_token($mockedEncryptor, $mockedStorage) {
        $mockedEncryptor->encrypt('token')->willReturn('encryptedToken');
        $mockedStorage->put('token', 'encryptedToken')->shouldBeCalled();

        $this->put('token');
    }

    function it_should_retrieve_token($mockedEncryptor, $mockedStorage) {
        $mockedStorage->has('token')->willReturn(true);
        $mockedStorage->get('token')->willReturn('encryptedToken');
        $mockedEncryptor->decrypt('encryptedToken')->willReturn('decryptedToken');

        $this->get()->shouldReturn('decryptedToken');
    }

    function it_should_throw_an_error_if_storage_does_not_have_token($mockedEncryptor, $mockedStorage) {
        $mockedStorage->has('token')->willReturn(false);

        $missingTokenException = new MissingTokenException('No token available');

        $this->shouldThrow($missingTokenException)->duringGet();
    }
}
