# Correção do Problema de Login com Senha Criptografada

## Problema Identificado

O sistema estava cadastrando senhas criptografadas usando `password_hash()`, mas o campo `senha` na tabela `empresas` estava definido como `VARCHAR(50)`, que é insuficiente para armazenar hashes bcrypt.

### Detalhes Técnicos:
- **Hash bcrypt** gerado por `password_hash()` tem aproximadamente 60 caracteres
- **Campo no banco**: `VARCHAR(50)` - truncava o hash, tornando impossível a verificação
- **Resultado**: Senhas sempre retornavam como incorretas no login

## Solução Implementada

### 1. Correção do Banco de Dados
Execute o script SQL `fix_senha_empresas.sql` para alterar o campo:

```sql
ALTER TABLE `empresas` MODIFY `senha` VARCHAR(255) DEFAULT NULL;
```

### 2. Código de Login (já estava correto)
O arquivo `login.php` já utiliza corretamente:
- `password_hash()` no cadastro
- `password_verify()` no login

### 3. Como Aplicar a Correção

**Opção 1 - Via phpMyAdmin:**
1. Acesse phpMyAdmin
2. Selecione o banco de dados `nexus_teste_354`
3. Vá em SQL
4. Cole e execute o conteúdo de `fix_senha_empresas.sql`

**Opção 2 - Via linha de comando:**
```bash
mysql -u root -p nexus_teste_354 < fix_senha_empresas.sql
```

### 4. Após a Correção

As empresas já cadastradas precisarão ter suas senhas redefinidas, pois os hashes foram truncados. Você pode:

1. Deletar e recadastrar as empresas
2. Ou criar um script para resetar as senhas

## Verificação

Após aplicar a correção:
1. Cadastre uma nova empresa
2. Tente fazer login com as credenciais cadastradas
3. O login deve funcionar corretamente
