SELECT 
	sui.item_id,
	si.name,
	si.display_name,
   COUNT(sui.item_id) anzahl
FROM 
    store_users_items sui
LEFT JOIN
	store_items si ON (sui.item_id = si.id)
GROUP BY 
    sui.item_id
ORDER BY 
    anzahl DESC