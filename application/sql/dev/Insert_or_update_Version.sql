INSERT INTO store_versions (mod_name, mod_description, mod_ver_convar, mod_ver_number, server_id, last_updated) 
VALUES ('test_mod_name', 'test_mod_descr', 'blabla_plugin', '2.0.0', '1', NOW()) 
ON DUPLICATE KEY UPDATE mod_name = VALUES(mod_name), mod_description = VALUES(mod_description), mod_ver_convar = VALUES(mod_ver_convar), mod_ver_number = VALUES(mod_ver_number), server_id = VALUES(server_id), last_updated = NOW();
