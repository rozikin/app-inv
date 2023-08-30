SELECT t.id
	,t.date
     , t.debit
     , t.credit

     , ( SELECT SUM(bi.qty)
           FROM v_material_in bi
          WHERE bi.date_in <= t.date
            AND ( bi.date_in < t.date
                OR ( t.i_or_r = 'i' AND bi.id_item <= t.id )
                )
       )
     - ( SELECT SUM(br.qty)
           FROM v_material_out br
          WHERE br.date_out <= t.date
            AND ( br.date_out < t.date
                OR ( t.i_or_r = 'r' AND br.id_item <= t.id )
                OR t.i_or_r = 'i'
                )
       ) AS balance

  FROM ( SELECT i.date_in       AS date
              , i.qty      AS debit
              , 0              AS credit
              , 'i'            AS i_or_r
              , i.id_item        AS id
           FROM v_material_in i
          UNION ALL
         SELECT r.date_out      AS date
              , 0              AS debit
              , r.qty    AS credit
              , 'r'            AS i_or_r
              , r.id_item        AS id
           FROM v_material_out r
       ) t
 ORDER BY t.date, t.i_or_r, t.id