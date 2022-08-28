<?php

namespace Alura\Arquitetura\Aluno;

use InvalidArgumentException;

class Telefone
{
    private string $ddd;
    private string $numero;

    public function __construct(string $ddd, string $numero)
    {
        $this->setDdd($ddd);
        $this->setNumero($numero);
    }

    private function setDdd(string $ddd)
    {

        $opcoes = [
            'options' => [
                'regexp' => '/\d{3}/'
            ]
        ];

        if (filter_var($ddd, FILTER_VALIDATE_REGEXP, $opcoes) === false) {
            throw new InvalidArgumentException('O ddd está invalido');
        }

        $this->ddd = $ddd;
    }

    private function setNumero(string $numero)
    {
        $opcoes = [
            'options' => [
                'regexp' => '/\d{4,5}\-\d{4}/'
            ]
        ];

        if (filter_var($numero, FILTER_VALIDATE_REGEXP, $opcoes) === false) {
            throw new InvalidArgumentException('O número está invalido');
        }

        $this->numero = $numero;
    }

    public function __toString()
    {
        return "({$this->ddd})" . " " . $this->numero;
    }
}
