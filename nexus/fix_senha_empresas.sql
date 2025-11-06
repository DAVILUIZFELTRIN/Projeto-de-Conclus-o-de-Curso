-- Corrigir o tamanho do campo senha na tabela empresas
-- O campo precisa ter 255 caracteres para armazenar hashes bcrypt corretamente

ALTER TABLE `empresas` MODIFY `senha` VARCHAR(255) DEFAULT NULL;
