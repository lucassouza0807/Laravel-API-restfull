# Documentação
<p>OBS: Para ter acesso á qualquer recurso dessa API você precisa ter a API secret essa api não é pública<p>
<p>Caso tente acessar sem a API secret será enviada uma mensagem de erro de código 401 conforme a imagem abaixo.<p>

![401](https://user-images.githubusercontent.com/66807618/181143641-e08b6521-3546-4f7b-8a01-ef2c6f3b80a1.png)

<h3>Exemplos:<h3>

#### OBS: Todos os retornos da chamada dessa api vem páginada, por padrão está são exibidos 10 resultados por pagína
##### Exemplo da paginação:

![paginacao](https://user-images.githubusercontent.com/66807618/181145689-4cb72dd4-66ed-4a86-ab1c-b193ff94a6d7.png)

### Para acessar todos o produtos:
###### http://localhost:8000/api/v1/produtos/index

### Para filtrar por nome
###### http://localhost:8000/api/v1/produto/produto_nome_exemplo

### Para ordenar apenas adicione a seguinte query string no final da URL
###### http://localhost:8000/api/v1/produto/produto_nome_exemplo?sort=preco
###### http://localhost:8000/api/v1/produto/produto_nome_exemplo?sort=preco_desc
###### http://localhost:8000/api/v1/produto/produto_nome_exemplo?sort=fabricante
###### http://localhost:8000/api/v1/produto/produto_nome_exemplo?sort=ofertas