<?php

namespace Alura\Arquitetura\Indicacao;

use Alura\Arquitetura\Aluno\Aluno;

class Indicacao
{
    private Aluno $indicante;
    private Aluno $indicado;

    public function __construct(Aluno $indicante, Aluno $indicado)
    {
        $this->indicante = $indicante;
        $this->indicado = $indicado;
    }
}
