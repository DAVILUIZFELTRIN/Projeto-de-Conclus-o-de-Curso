    <?php
    include 'includes/conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user_type = $_POST["user_type"];

        $table = "";
        $id_field = "";
        $password_field = "";
        $sql = ""; 
        // Flag para saber qual método de verificação de senha usar
        $use_password_verify = false; 

        // ...
    switch ($user_type) {
    case "empresa":
            $table = "empresas";
            $id_field = "id_empresa";
            $password_field = "senha";
            $sql = "SELECT $id_field, email, $password_field FROM $table WHERE email = ?"; 
            // Senha CRIPTOGRAFADA (CORRETO!)
            $use_password_verify = true; // <-- DEVE SER TRUE
            break;
    // ...
            case "psicologo":
                $table = "psicologos";
                $id_field = "id_psicologo";
                $password_field = "senha";
                $sql = "SELECT $id_field, email, $password_field FROM $table WHERE email = ?";
                // Psicólogos usam senha criptografada (hashed)
                $use_password_verify = true; 
                break;
            case "administrador":
                $table = "usuarios";
                $id_field = "id_usuario";
                $password_field = "senha";
                $sql = "SELECT $id_field, email, $password_field, tipo FROM $table WHERE email = ? AND tipo = 'admin'"; 
                // Administradores usam senha em texto simples (ou não foram atualizadas)
                $use_password_verify = false;
                break;
            default:
                echo "Tipo de usuário inválido.";
                exit();
        }

        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            die("Erro na preparação da query: " . $conn->error);
        }
        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            
            $password_match = false;

            
                  // --- NOVO BLOCO DE VERIFICAÇÃO DE SENHA CORRIGIDO ---
        if ($use_password_verify) {
            // Para Empresa e Psicólogos (Senha Criptografada)
            if (password_verify($password, $user[$password_field])) {
                $password_match = true;
            }
        } else {
            // Para Administrador (Senha em Texto Simples)
            if ($password == $user[$password_field]) {
                $password_match = true;
            }
        }
        // --- FIM NOVO BLOCO ---

            
            
            if ($password_match) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user[$id_field];
                $_SESSION["email"] = $user["email"];
                $_SESSION["user_type"] = $user_type;

                // Redirecionar para o painel apropriado
                switch ($user_type) {
                    case "empresa":
                        header("Location: dashboard_empresa.php");
                        break;
                    case "psicologo":
                        header("Location: dashboard_psicologo.php");
                        break;
                    case "administrador":
                        header("Location: dashboard_admin.php");
                        break;
                }
                exit();
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Nenhum usuário encontrado com este email ou tipo de usuário.";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
