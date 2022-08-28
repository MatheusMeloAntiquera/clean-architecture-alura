<?php

namespace Alura\Arquitetura;

use Alura\Arquitetura\Aluno;

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
