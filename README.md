php_formsec
===========


EN
-----------
this is a php class to help the build of a new form

the idea is to create simple and secure forms.

PT
-----------
PHP FORMsec é uma classe php cuja principal função é gerar formulários seguros de baixa manutenção.

Quero com isto dizer que esta class irá ser responsável por gerar os campos, as labels e os scripts necessários para que o formulário seja apresentado correctamente e tenha o comportamento esperado.

Para alem das características normais do formulário esta class será ainda responsável por receber a informação submetida, e "limpa-la de impurezas" de forma a que seja seguro processar a informação submetida.

É de baixa manutenção pois os formulários serão criados como objectos desta class e poderão assim ser chamados quando necessário. Como cada tipo de campo é criado individualmente, poderão ainda ser corrigidas ou adicionadas funcionalidades facilmente sendo para isso necessário apenas actualizar a função de "renderização" de cada campo.
