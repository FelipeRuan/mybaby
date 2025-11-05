<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyConnect - Comunidade de Maternidade</title>
    <style>
        /* Reset e estilos gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        /* Cores temáticas para maternidade */
        :root {
            --primary: #FF69B4;
            --secondary: #87CEEB;
            --accent: #FFD700;
            --light: #FFF5F7;
            --dark: #333;
        }
        
        /* Header */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary);
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        .nav-links {
            display: flex;
            gap: 25px;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--primary);
        }
        
        .nav-icons {
            display: flex;
            gap: 20px;
        }
        
        .icon {
            font-size: 1.3rem;
            cursor: pointer;
        }
        
        /* Container principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Seção de reels */
        .reels-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .reels-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .reel-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .reel-card:hover {
            transform: translateY(-5px);
        }
        
        .reel-video {
            width: 100%;
            height: 400px;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            position: relative;
        }
        
        .reel-info {
            padding: 15px;
        }
        
        .reel-user {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .reel-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
        }
        
        .action-btn:hover {
            color: var(--primary);
        }
        
        /* Seção de marketplace */
        .marketplace-section {
            margin-bottom: 40px;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            width: 100%;
            height: 200px;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
        }
        
        .product-info {
            padding: 15px;
        }
        
        .product-price {
            font-weight: bold;
            color: var(--primary);
            margin: 10px 0;
        }
        
        .add-to-cart {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        .add-to-cart:hover {
            background-color: #e0559c;
        }
        
        /* Upload section */
        .upload-section {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        
        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s;
        }
        
        .upload-area:hover {
            border-color: var(--primary);
        }
        
        .upload-icon {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 40px 0;
            margin-top: 40px;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }
        
        .footer-column h3 {
            margin-bottom: 20px;
            color: var(--accent);
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column ul li {
            margin-bottom: 10px;
        }
        
        .footer-column a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-column a:hover {
            color: var(--primary);
        }
        
        .copyright {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #444;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .reels-container, .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <header>
        <div class="navbar">
            <div class="logo">Baby<span>Connect</span></div>
            <div class="nav-links">
                <a href="#home">Início</a>
                <a href="#reels">Reels</a>
                <a href="#marketplace">Marketplace</a>
                <a href="#comunidade">Comunidade</a>
                <a href="#sobre">Sobre</a>
            </div>
            <div class="nav-icons">
                <div class="icon">🔍</div>
                <div class="icon">🛒</div>
                <div class="icon">👤</div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <div class="container">
        <!-- Seção de Upload -->
        <section class="upload-section">
            <h2 class="section-title">Compartilhe seu momento</h2>
            <div class="upload-area">
                <div class="upload-icon">📤</div>
                <p>Arraste e solte seu vídeo aqui ou clique para selecionar</p>
                <p><small>Formatos suportados: MP4, MOV, AVI (máx. 100MB)</small></p>
            </div>
        </section>

        <!-- Seção de Reels -->
        <section class="reels-section" id="reels">
            <h2 class="section-title">Reels da Comunidade</h2>
            <div class="reels-container">
                <!-- Reel 1 -->
                <div class="reel-card">
                    <div class="reel-video">
                        [Vídeo: Dicas para amamentação]
                    </div>
                    <div class="reel-info">
                        <div class="reel-user">
                            <div class="user-avatar">A</div>
                            <div>
                                <strong>Ana Silva</strong>
                                <div class="user-badge">Mãe de primeira viagem</div>
                            </div>
                        </div>
                        <p>Dicas valiosas para quem está começando a amamentar!</p>
                        <div class="reel-actions">
                            <button class="action-btn">❤️ 245</button>
                            <button class="action-btn">💬 42</button>
                            <button class="action-btn">↗️ Compartilhar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Reel 2 -->
                <div class="reel-card">
                    <div class="reel-video">
                        [Vídeo: Organização do quarto do bebê]
                    </div>
                    <div class="reel-info">
                        <div class="reel-user">
                            <div class="user-avatar">M</div>
                            <div>
                                <strong>Mariana Costa</strong>
                                <div class="user-badge">Mãe de gêmeos</div>
                            </div>
                        </div>
                        <p>Como organizar um espaço pequeno para dois bebês!</p>
                        <div class="reel-actions">
                            <button class="action-btn">❤️ 189</button>
                            <button class="action-btn">💬 31</button>
                            <button class="action-btn">↗️ Compartilhar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Reel 3 -->
                <div class="reel-card">
                    <div class="reel-video">
                        [Vídeo: Exercícios pós-parto]
                    </div>
                    <div class="reel-info">
                        <div class="reel-user">
                            <div class="user-avatar">C</div>
                            <div>
                                <strong>Carla Mendes</strong>
                                <div class="user-badge">Educadora física</div>
                            </div>
                        </div>
                        <p>Sequência de exercícios leves para recuperação pós-parto.</p>
                        <div class="reel-actions">
                            <button class="action-btn">❤️ 312</button>
                            <button class="action-btn">💬 56</button>
                            <button class="action-btn">↗️ Compartilhar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção Marketplace -->
        <section class="marketplace-section" id="marketplace">
            <h2 class="section-title">Marketplace - Produtos para Maternidade</h2>
            <div class="products-grid">
                <!-- Produto 1 -->
                <div class="product-card">
                    <div class="product-image">
                        [Imagem: Carrinho de Bebê]
                    </div>
                    <div class="product-info">
                        <h3>Carrinho de Bebê Compacto</h3>
                        <p>Perfeito para pais urbanos, fácil de transportar.</p>
                        <div class="product-price">R$ 599,90</div>
                        <button class="add-to-cart">Adicionar ao Carrinho</button>
                    </div>
                </div>
                
                <!-- Produto 2 -->
                <div class="product-card">
                    <div class="product-image">
                        [Imagem: Sutiã de Amamentação]
                    </div>
                    <div class="product-info">
                        <h3>Sutiã de Amamentação</h3>
                        <p>Conforto e praticidade para o dia a dia.</p>
                        <div class="product-price">R$ 49,90</div>
                        <button class="add-to-cart">Adicionar ao Carrinho</button>
                    </div>
                </div>
                
                <!-- Produto 3 -->
                <div class="product-card">
                    <div class="product-image">
                        [Imagem: Kit Berço]
                    </div>
                    <div class="product-info">
                        <h3>Kit Berço 8 Peças</h3>
                        <p>Conjunto completo com lençol, edredom e mais.</p>
                        <div class="product-price">R$ 189,90</div>
                        <button class="add-to-cart">Adicionar ao Carrinho</button>
                    </div>
                </div>
                
                <!-- Produto 4 -->
                <div class="product-card">
                    <div class="product-image">
                        [Imagem: Bomba Elétrica]
                    </div>
                    <div class="product-info">
                        <h3>Bomba Elétrica para Amamentação</h3>
                        <p>Tecnologia avançada para maior conforto.</p>
                        <div class="product-price">R$ 299,90</div>
                        <button class="add-to-cart">Adicionar ao Carrinho</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>BabyConnect</h3>
                <p>Uma comunidade dedicada a conectar e apoiar Pais em todas as fases da maternidade.</p>
            </div>
            <div class="footer-column">
                <h3>Links Rápidos</h3>
                <ul>
                    <li><a href="#home">Início</a></li>
                    <li><a href="#reels">Reels</a></li>
                    <li><a href="#marketplace">Marketplace</a></li>
                    <li><a href="#comunidade">Comunidade</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Suporte</h3>
                <ul>
                    <li><a href="#ajuda">Central de Ajuda</a></li>
                    <li><a href="#contato">Contato</a></li>
                    <li><a href="#privacidade">Política de Privacidade</a></li>
                    <li><a href="#termos">Termos de Uso</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Newsletter</h3>
                <p>Inscreva-se para receber dicas e novidades sobre maternidade.</p>
                <input type="email" placeholder="Seu e-mail" style="padding: 8px; width: 100%; margin: 10px 0; border-radius: 5px; border: none;">
                <button style="background-color: var(--primary); color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; width: 100%;">Inscrever</button>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 BabyConnect. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        // Funcionalidades básicas em JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Simulação de upload de vídeo
            const uploadArea = document.querySelector('.upload-area');
            uploadArea.addEventListener('click', function() {
                alert('Funcionalidade de upload será implementada!');
            });
            
            // Simulação de curtir um reel
            const likeButtons = document.querySelectorAll('.action-btn');
            likeButtons.forEach(button => {
                if (button.textContent.includes('❤️')) {
                    button.addEventListener('click', function() {
                        const currentLikes = parseInt(this.textContent.match(/\d+/)[0]);
                        this.textContent = `❤️ ${currentLikes + 1}`;
                    });
                }
            });
            
            // Simulação de adicionar ao carrinho
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productName = this.closest('.product-info').querySelector('h3').textContent;
                    alert(`${productName} adicionado ao carrinho!`);
                });
            });
        });
    </script>
</body>
</html>