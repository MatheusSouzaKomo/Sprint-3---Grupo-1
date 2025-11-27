 use sistema_gurus;
 
 -- Insert ao login --
 insert into login (nome ,email, senha, nivel_acesso) 
 Values ('Matheus Souza', 'matheus.sbs03@gmail.com', 'Queijo10@', 1);
 
 insert into login (nome, email, senha, nivel_acesso) 
 Values ('Giovanni Chianesi', 'giovanni.chianesi@gmail.com', 'Banana10@', 2);
 
 insert into login (nome, email, senha, nivel_acesso) 
 Values ('Kauã Mariano', 'kaua.mariano@gmail.com', 'Maca10@', 3);
 
 -- Insert nas reclamações e avaliações  --
 
 Insert into reclamacao (msg_reclamacao, setor_reclamacao, id_usuario)
 values ('A empresa Guru já demonstrou muito potencial na educação, mas atualmente está pecando nas escolas SESI e SENAI.', 2, 1);
 
  Insert into reclamacao (msg_reclamacao, setor_reclamacao, id_usuario)
 values ('Demorei mais de 3 horas pra chegar em casa por conta dessa merda do I06! Consertem essa linha!', 6, 2);
 
 insert into reclamacao (msg_reclamacao, setor_reclamacao, id_usuario)
values ('O atendimento do suporte está muito lento hoje! Precisei esperar quase 40 minutos para ser atendido!', 6, 3);
 
 insert into avaliacao (msg_avaliacao, setor_avaliacao, id_usuario, nota_avaliacao)
 values ('Moro aqui na cidade sobre segurança da Guru e nunca me senti tão seguro! 10/10!', 5, 1, '5');
 
  insert into avaliacao (msg_avaliacao, setor_avaliacao, id_usuario, nota_avaliacao)
 values ('Moro na casa do Benício, já foi vítima de bala perdida. Corre aqui, Gurus!', 5, 2, '3');
 
 insert into avaliacao (msg_avaliacao, setor_avaliacao, id_usuario, nota_avaliacao)
values ('O site está cada vez melhor! Navegação rápida e tudo muito organizado. Parabéns ao administrador!', 5, 3, '5');

 
 -- Seleção para visualização das reclamações específicas-- 

select 
l.nome as 'Nome do usuário',
l.nivel_acesso as 'Nível de Acesso',
l.email as 'Email do emissor da reclamação', 
r.msg_reclamacao as 'Mensagem de Reclamação', 
r.setor_reclamacao as 'Setor da Reclamação'
 from login as l INNER JOIN reclamacao as r 
    On l.id_usuario = r.id_usuario 
     where l.id_usuario = 1; -- Seleção das reclamações APENAS do usuário do id 1: Matheus Souza.

-- Seleção para visualização das avaliações específicas --

select
l.nome as 'Nome do usuário',
l.nivel_acesso as 'Nível de Acesso',
l.email as 'Email do emissor da avaliação',
a.msg_avaliacao as 'Avaliações do nosso serviço',
a.setor_avaliacao as 'Setor da avaliação',
a.nota_avaliacao as 'Estrelas'
	 from login as l INNER JOIN avaliacao as a
    On l.id_usuario = a.id_usuario 
    where l.id_usuario = 2; -- Seleção das avaliações APENAS do usuário do id 2: Giovanni Chianesi
    
-- Seleção total -- 
select
l.nome as 'Nome dos usuários',
l.nivel_acesso as 'Nível de Acesso',
l.email as 'Email dos usuários',
r.msg_reclamacao as 'Reclamações Efetuadas',
a.msg_avaliacao as 'Avaliações Efetuadas'
	from login as l 
    LEFT JOIN reclamacao as r ON l.id_usuario = r.id_usuario -- Houve mudança do INNER JOIN para left join pela necessidade de juntar os dois... e INNER JOIN estava sobrepondo as informações
    LEFT JOIN avaliacao as a ON l.id_usuario = a.id_usuario;
    
    -- Seleção por nível de acesso --
select 
l.nome as 'Nome dos usuários',
l.nivel_acesso as 'Nível de Acesso',
l.email as 'Email dos usuários',
r.msg_reclamacao as 'Reclamações Efetuadas',
a.msg_avaliacao as 'Avaliações Efetuadas'
    from login as l
    LEFT JOIN reclamacao as r ON l.id_usuario = r.id_usuario 
    LEFT JOIN avaliacao as a ON l.id_usuario = a.id_usuario
		where l.nivel_acesso = 3; -- Nível 3, o nível mais alto, administrador



 
