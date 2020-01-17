# Accel-Manager v0.1.0

## Sobre

Este softare tem o propósito de trazer as funcionalidades básicas utilizadas pelo time de suporte técnico ao operar um B-RAS, neste caso rodando o Accel-PPP. Trata-se de um ótimo software, porém a curva de aprendizado para uma equipe acostumada a utilizar soluções como Winbox para equipamentos Mikrotik, se tornou demaseadamente grande, e para suavisar essa curva, me propus a escrever este software, e aqui disponibilizo para toda a comunidade que tiver interesse em estar utilizando e/ou contribuindo para o projeto.

Trata-se de um esboço inicial, em fase muito embrionária ainda, ainda assim tráz algumas funcionalidade muito interessantes como:
 - Controle de Acesso de usuários por ACL/Profiles
 - Listagem de sessões ativas com opções de:
    - Ordenação (Crescente/Decrescente) 
    - Cosulta (por Interface, Usuário e IPv4)
    - Ações para:
        - Abertura de gráfico para visualizar em tempo real o tráfego dos ultimos 60 segundos da conexão.
        - Alteração dos parametros de rate-limit (aqui apelidade de Queue para facilitar a associação com o mundo RouterOS)
        - Restauração dos parametros de rate-limit
        - Derrubar conexão ativa

Para o desenvolvimeto deste projeto, utilizei o aparato tecnológico que estou mais familiarizado:
    - Laravel (Framework PHP)
    - Vuejs (Biblioteca JavaScript)
    - Axios (Bibilioteca Javascript para consumo de WebServices)
    - Bootstrap 4 (Estilização CSS)

Todos os pacotes de software agregados ao projeto estão nas suas versões mais atuais.