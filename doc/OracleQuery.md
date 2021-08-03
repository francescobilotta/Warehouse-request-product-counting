-- Selezione articolo per autocompilazione -- select a.cod_articolo, a.descrizione from anart055 a where a.cod_azienda
= 'FG' and a.disabilitato = 0 Order by a.cod_articolo

-- Selezione delle varianti, inserire come input il cod_articolo-- select a.cod_articolo, a.descrizione, a.cod_combi,
abb.progressivo VARIANTE from anart055 a, abbin072 abb where a.cod_azienda = 'FG' and a.disabilitato = 0 and
a.cod_articolo = '11210' and abb.cod_azienda (+) = a.cod_azienda and abb.cod_articolo (+) = a.cod_articolo and
abb.disabilitato (+) = a.disabilitato

---!!! SEZIONE WAREHOUSE !!!---

-- Selezione dell'ubicazione predefinita (può non esserci), inserire come input il cod_articolo e il cod_variante -- --
ATTENZIONE: potete trovare record multipli select l.cod_articolo, l.cod_variante, l.loc_default, l.zona, l.corridoio,
l.traversa, l.altezza from layou050 l where l.cod_azienda = 'FG' and l.cod_deposito = 'FG' and l.disabilitato = 0 and
l.loc_default = 1 and l.cod_articolo = '11210' and l.cod_variante = 'FERRARI'

--Selezione della giacenza totale nel deposito FG, dati di input cod_articolo e il cod_variante e cod_esercizio (= anno
in corso) -- select s.cod_articolo, s.cod_combiprogr, s.n_tot from salmv165 s where s.cod_azienda = 'FG' and
s.cod_deposito = 'FG' and s.area_utilizzo = 'M' and s.cod_articolo = '11210' and s.cod_combiprogr = 'FERRARI' and
s.cod_esercizio = '2021'

-- Selezione dei pezzi a terra o in procinto di essere prelevati -- SELECT T.cod_esercizio, T.cod_tipo_doc,
T.cod_num_doc, T.cod_interl_sped, I.ragsociale, T.dt_cons_rich, R.cod_articolo, R.cod_combiprogr, A.descrizione, SUM(
R.qta_ord) AS ORDINATO, SUM(R.qta_prelievo) AS ACCAP, SUM(R.qta_colli) AS PRELEVATO, R.eser_prelievo, R.num_prelievo
FROM tmovm066 T, rmovm060 R, anart055 A, inter080 I WHERE T.cod_esercizio = R.cod_esercizio AND T.cod_numreg =
R.cod_numreg AND T.cod_azienda = R.cod_azienda AND T.COD_TIPO_DOC Like 'OC%' and t.cod_esercizio in ('2020','2021')
AND R.cod_articolo = '11210' and r.cod_combiprogr = 'FERRARI' AND T.cod_azienda = 'FG' AND T.doc_chiuso = '0' AND
R.riga_chiusa = '0' AND T.cod_sigla_doc = 'A' AND A.cod_azienda = T.cod_azienda AND A.cod_articolo = R.cod_articolo AND
I.cod_azienda = T.cod_azienda AND I.cod_interl = T.cod_interl_sped GROUP BY T.COD_TIPO_DOC, T.COD_NUM_DOC,
R.COD_ARTICOLO, R.COD_COMBIPROGR, I.ragsociale, T.COD_AZIENDA, T.DOC_CHIUSO, A.descrizione, R.RIGA_CHIUSA,
T.COD_SIGLA_DOC, T.cod_esercizio, T.dt_cons_rich,R.eser_prelievo, R.num_prelievo, T.cod_interl_sped ORDER BY
R.COD_ARTICOLO, R.COD_COMBIPROGR, T.COD_INTERL_SPED, T.dt_cons_rich
