<?php 

namespace App\Http\Responses;

use Throwable;

class ErrorResponse
{
    /**
     * Função de retorno do error
     * @param Throwable $th
     * @return array
     */
    public function error(Throwable $th): array
    {
        return ['message' => explode("\n", $th->getMessage()), 'code' => $th->getCode()];
    }

    /**
     * Retorna mensagem de erro personalizada de registro não encontrado
     * @return array
     */
    public function errorNotFound(): array
    {
        return ['message' => 'Registro não encontrado!', 'code' => 404];
    }

    /**
     * Retorna mensagem de erro personalizado quando o registro já existe
     * @return array
     */
    public function errorExists(): array
    {
        return ['message' => 'Registro já está cadastrado', 'code' => 422];
    }

    /**
     * Retorna uma mensagem padrão de erro no fluxo
     * @return array
     */
    public function errorException(): array
    {
        return ['message' => 'Houve um problema ao executar a função solicitada!', 'code' => 500];
    }

    /**
     * Retorna uma mensagem personalizada quando falha o update
     * @return array
     */
    public function errorUpdate(): array
    {
        return ['message' => 'Houve um erro ao atualizar o registro!', 'code' => 500];
    }

    /**
     * Retorna uma mensagem personalizada quando falha o delete
     * @return array
     */
    public function errorDelete(): array
    {
        return ['message' => 'Houve um erro ao excluir o registro!', 'code' => 500];
    }
}
