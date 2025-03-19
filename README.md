# Projeto de Endomarketing - Assinatura e Avatar em PHP

## 📌 Descrição
Este projeto foi desenvolvido para automatizar a criação de assinaturas personalizadas e avatares para uso interno da empresa. Ele permite que os usuários editem seus avatares e gerem assinaturas padronizadas, garantindo uma identidade visual consistente, de forma simples e sem necessidade de integração com banco de dados.

## 🚀 Funcionalidades
- **Geração de assinaturas personalizadas** com nome, cargo, departamento e informações de contato.
- **Edição de avatares** com opções de upload e personalização.
- **Cópia rápida da assinatura** para fácil inserção no e-mail.
- **Máscaras de telefone dinâmicas** usando jQuery.
- **Seleção automática da identidade visual** com base na empresa do usuário.
- **Interface simples e intuitiva** para facilitar a experiência do usuário.
- **Gerenciamento de empresas e avatares** através da página de manutenção.
- **Não requer banco de dados**, garantindo facilidade de implementação.

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
│-- 📄 manutencao.php  # Página para adicionar novas empresas, logos e avatares
│-- 📄 assinatura.php  # Gerador de assinaturas de e-mail
│-- 📄 inicio.php  # Página inicial do sistema (não enviada, mas referenciada)
│-- 📁 assets/logos  # Logos das empresas
│-- 📁 assets/avatares  # Avatares das empresas
```

## 🚀 Como Usar
1. Faça o clone do repositório:
   ```sh
   git clone https://github.com/seuusuario/projeto-endomarketing.git
   ```
2. Suba os arquivos para o servidor e acesse `index.html`.
3. Preencha os campos no `assinatura.php` para gerar sua assinatura personalizada.
4. O sistema atribuirá a identidade visual da empresa escolhida automaticamente.
5. Copie e cole a assinatura gerada no seu e-mail.
6. Para adicionar novas empresas, logos ou avatares, utilize `manutencao.php`.

## 🛠️ Manutenção
A página `manutencao.php` é utilizada para adicionar novas empresas, logos e avatares ao sistema, sem necessidade de integração com banco de dados.

---
📧 **Autor:** Maik Lima 
🔗 **GitHub:** [Maik Lima]([https://github.com/seuusuario](https://github.com/Maikantoniolima))

