<?php

namespace App\Constants;

class Messages
{
    // Mensagens Genéricas de Sucesso
    const SUCCESS_CREATED = 'Registro criado com sucesso';
    const SUCCESS_UPDATED = 'Registro atualizado com sucesso';
    const SUCCESS_DELETED = 'Registro removido com sucesso';
    const SUCCESS_LISTED = 'Registros recuperados com sucesso';
    const SUCCESS_FOUND = 'Registro encontrado com sucesso';

    // Mensagens Genéricas de Erro
    const ERROR_NOT_FOUND = 'Registro não encontrado';
    const ERROR_CREATING = 'Erro ao criar registro';
    const ERROR_UPDATING = 'Erro ao atualizar registro';
    const ERROR_DELETING = 'Erro ao remover registro';
    const ERROR_LISTING = 'Erro ao listar registros';
    const ERROR_FINDING = 'Erro ao buscar registro';

    // Contexto: Auth
    const CONTEXT_AUTH = [
        'success' => [
            'login' => 'Login realizado com sucesso',
            'logout' => 'Logout realizado com sucesso',
            'register' => 'Usuário registrado com sucesso'
        ],
        'error' => [
            'invalid_credentials' => 'Credenciais inválidas',
            'unauthorized' => 'Não autorizado',
            'token_expired' => 'Token expirado',
            'token_invalid' => 'Token inválido',
            'register' => 'Erro ao registrar usuário'
        ]
    ];

    /**
     * Retorna mensagem genérica
     */
    public static function get(string $type, string $action): string
    {
        $constant = match("${type}_${action}") {
            'success_created' => self::SUCCESS_CREATED,
            'success_updated' => self::SUCCESS_UPDATED,
            'success_deleted' => self::SUCCESS_DELETED,
            'success_listed' => self::SUCCESS_LISTED,
            'success_found' => self::SUCCESS_FOUND,
            'error_not_found' => self::ERROR_NOT_FOUND,
            'error_creating' => self::ERROR_CREATING,
            'error_updating' => self::ERROR_UPDATING,
            'error_deleting' => self::ERROR_DELETING,
            'error_listing' => self::ERROR_LISTING,
            'error_finding' => self::ERROR_FINDING,
            default => 'Operação realizada'
        };
        return $constant;
    }
}
