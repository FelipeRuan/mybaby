<?php
// Validação do token CSRF logo no início
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$page_title = "Cadastro";
include 'app/views/templates/header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cadastre-se na plataforma MyBaby">
    <title><?php echo htmlspecialchars($page_title); ?> - BabyConnect</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <main class="auth-container">
        <div class="auth-card">
        <h2>Junte-se à Nossa Comunidade</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <form action="index.php?action=register" method="POST" id="registerForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <div class="form-group">
                <label for="nome">
                    <i class="fas fa-user"></i> Nome Completo
                </label>
                <input type="text" 
                       id="nome" 
                       name="nome" 
                       required 
                       minlength="3"
                       maxlength="100"
                       pattern="[A-Za-zÀ-ÿ\s]+"
                       value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>"
                       aria-describedby="nomeError">
                <span class="error" id="nomeError"></span>
            </div>
            
            <div class="form-group">
                <label for="email">
                <i class="fas fa-envelope"></i> Email
                </label>
                <input type="email"
                   id="email"
                   name="email"
                   required
                   autocomplete="email"
                   maxlength="255"
                   placeholder="seu@email.com"
                   aria-describedby="emailError"
                   value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                <span class="error" id="emailError"></span>
            </div>
            
            <div class="form-group">
                <label for="tipo">
                    <i class="fas fa-users"></i> Tipo de Conta
                </label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="mae" <?php echo ($_POST['tipo'] ?? '') == 'mae' ? 'selected' : ''; ?>>Mãe</option>
                    <option value="profissional" <?php echo ($_POST['tipo'] ?? '') == 'profissional' ? 'selected' : ''; ?>>Profissional da Saúde</option>
                    <option value="loja" <?php echo ($_POST['tipo'] ?? '') == 'loja' ? 'selected' : ''; ?>>Lojista</option>
                </select>
                <span class="error" id="tipoError"></span>
            </div>
            
            <div class="form-group">
                <label for="data_nascimento">
                    <i class="fas fa-calendar"></i> Data de Nascimento
                </label>
                <input type="date" id="data_nascimento" name="data_nascimento"
                       value="<?php echo $_POST['data_nascimento'] ?? ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="telefone">
                    <i class="fas fa-phone"></i> Telefone
                </label>
                <input type="tel" id="telefone" name="telefone"
                       value="<?php echo $_POST['telefone'] ?? ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="senha">
                    <i class="fas fa-lock"></i> Senha
                </label>
                <div class="password-input">
                    <input type="password" 
                           id="senha" 
                           name="senha" 
                           required
                           minlength="8"
                           pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,}$"
                           aria-describedby="senhaError">
                    <button type="button" class="toggle-password" aria-label="Mostrar senha">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <small>Mínimo 8 caracteres, com letra maiúscula e número</small>
                <span class="error" id="senhaError"></span>
            </div>
            
            <div class="form-group">
                <label for="confirmar_senha">
                    <i class="fas fa-lock"></i> Confirmar Senha
                </label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                <span class="error" id="confirmarSenhaError"></span>
            </div>
            
            <div class="form-group">
                <label for="bio">
                    <i class="fas fa-edit"></i> Sobre Você (Opcional)
                </label>
                <textarea id="bio" name="bio" rows="3" 
                          placeholder="Conte um pouco sobre sua experiência..."><?php echo $_POST['bio'] ?? ''; ?></textarea>
            </div>
            
            <div class="form-options">
                <label class="checkbox">
                    <input type="checkbox" name="termos" required>
                    Concordo com os <a href="#" target="_blank">Termos de Uso</a> e 
                    <a href="#" target="_blank">Política de Privacidade</a>
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-user-plus"></i> Criar Conta
            </button>
        </form>
        
        <div class="auth-links">
            <p>Já tem uma conta? 
                <a href="index.php?page=login">Faça login aqui</a>
            </p>
        </div>
    </div>
    </main>

    <script src="assets/js/validation.js"></script>
    <?php include 'app/views/templates/footer.php'; ?>
</body>
</html>
