# Projeto de Endomarketing - Assinatura e Avatar em PHP

## 📌 Descrição
Este projeto foi desenvolvido para automatizar a criação de assinaturas personalizadas e avatares para uso interno da empresa. Ele permite que os usuários editem seus avatares e gerem assinaturas padronizadas, garantindo uma identidade visual consistente.

## 🚀 Funcionalidades
- **Geração de assinaturas personalizadas** com nome, cargo, departamento e informações de contato.
- **Edição de avatares** com opções de upload e personalização.
- **Cópia rápida da assinatura** para fácil inserção no e-mail.
- **Máscaras de telefone dinâmicas** usando jQuery.
- **Seleção automática da identidade visual** com base na empresa do usuário.
- **Interface simples e intuitiva** para facilitar a experiência do usuário.
- **Integração com banco de dados** para armazenamento de informações dos usuários.
- **Redirecionamento automático** em `index.html` para a página inicial do sistema.
- **Página de manutenção** para exibição de avisos temporários.

## 🏢 Empresas Suportadas
O sistema gera assinaturas personalizadas com base na identidade visual de cada empresa:

| Empresa | Cor Primária | Logo |
|---------|------------|------|
| Athos | #001D4A | athos.png |
| ApoioLab | #334A56 | apoiolab.png |
| BioBrasil | #002A50 | biobrasil.png |
| Bioplus | #2687C8 | bioplus.png |
| BP | #0E528B | bp.png |
| Grupo Bringel | #FF6616 | bringel.png |
| Bringel Medical | #283593 | bringelmedical.png |
| Gases da Amazonia | #36BA5C | gases.png |
| Lavnorte | #2086C8 | lavnorte.png |
| MicSteriliza | #005D91 | mic.png |
| VittaCard | #131B56 | vittacard.png |
| Norte Ambiental | #094D41 | norteambiental.png |

## 📂 Estrutura do Projeto
```
📁 projeto-endomarketing
│-- 📄 index.html  # Redireciona para a página inicial
│-- 📄 avatar_editar.php  # Permite edição e personalização do avatar
│-- 📄 manutencao.php  # Página de manutenção
│-- 📄 assinatura.php  # Gerador de assinaturas de e-mail
│-- 📄 config_empresas.php  # Lista de empresas e avatares
│-- 📄 inicio.php  # Página inicial do sistema (não enviada, mas referenciada)
│-- 📁 assets/logos  # Logos das empresas
│-- 📁 assets/avatares  # Avatares dos usuários
```

## 🚀 Como Usar
1. Faça o clone do repositório:
   ```sh
   git clone https://github.com/seuusuario/projeto-endomarketing.git
   ```
2. Certifique-se de que seu ambiente suporta PHP e MySQL.
3. Suba os arquivos para o servidor e acesse `index.html`.
4. Preencha os campos no `assinatura.php` para gerar sua assinatura personalizada.
5. O sistema atribuirá a identidade visual da empresa escolhida automaticamente.
6. Copie e cole a assinatura gerada no seu e-mail.

## 🛠️ Manutenção
Caso precise realizar ajustes, `manutencao.php` pode ser utilizado como página temporária para informar os usuários sobre atualizações no sistema.

---
📧 **Autor:** Seu Nome  
🔗 **GitHub:** [Seu Perfil](https://github.com/seuusuario)

