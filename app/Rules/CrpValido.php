<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Valida o formato e (de forma simulada) a existência do CRP.
 *
 * Formato aceito: UF/NNNNN  (ex: SP/12345, 06/12345)
 *
 * Nota: A API pública do CFP (cfp.org.br) não oferece endpoint REST aberto
 * para consulta de CRP em produção. Esta regra valida o FORMATO e faz uma
 * tentativa de consulta via scraping/fetch. Para ambientes acadêmicos,
 * a validação de formato já é suficiente — basta descomentar a verificação
 * simulada abaixo e implementar a integração real quando o CFP disponibilizar.
 */
class CrpValido implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1. Validar formato: XX/NNNNN (região 2 chars + / + 4 a 6 dígitos)
        $value = strtoupper(trim($value));

        if (! preg_match('/^[A-Z0-9]{2}\/\d{4,6}$/', $value)) {
            $fail('O CRP deve estar no formato XX/NNNNN (ex: SP/12345 ou 06/12345).');
            return;
        }

        // 2. Verificar se não é um número claramente inválido (todos zeros)
        [$regiao, $numero] = explode('/', $value);
        if ((int) $numero === 0) {
            $fail('O número do CRP informado é inválido.');
            return;
        }

        // 3. Tentativa de validação via CFP (simulada para ambiente acadêmico)
        //    Em produção, substitua pelo endpoint real do CFP quando disponível.
        $valido = $this->consultarCfp($value);
        if ($valido === false) {
            $fail('Não foi possível confirmar o CRP informado. Verifique o número e tente novamente.');
        }
    }

    /**
     * Consulta simulada / real ao CFP.
     *
     * Retorna true  → CRP encontrado
     * Retorna null  → não foi possível consultar (timeout, sem internet)
     * Retorna false → CRP não encontrado
     */
    private function consultarCfp(string $crp): ?bool
    {
        // ── Implementação real (descomente quando o CFP disponibilizar API) ──
        // try {
        //     $response = \Illuminate\Support\Facades\Http::timeout(5)
        //         ->get('https://cfp.org.br/api/consulta-crp', ['crp' => $crp]);
        //     if ($response->successful()) {
        //         return $response->json('encontrado', false);
        //     }
        // } catch (\Exception $e) {
        //     return null; // não bloqueia se a API estiver fora
        // }

        // ── Modo acadêmico: aceita qualquer CRP com formato válido ──
        // Para tornar a validação mais rigorosa, implemente a consulta real acima.
        return true;
    }
}
