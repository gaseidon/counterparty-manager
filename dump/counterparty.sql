-- Adminer 4.8.1 PostgreSQL 12.17 dump



DROP TABLE IF EXISTS "counterparties";
DROP SEQUENCE IF EXISTS counterparties_id_seq;
CREATE SEQUENCE counterparties_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."counterparties" (
    "id" bigint DEFAULT nextval('counterparties_id_seq') NOT NULL,
    "user_id" bigint NOT NULL,
    "inn" character varying(255) NOT NULL,
    "name" character varying(255) NOT NULL,
    "ogrn" character varying(255) NOT NULL,
    "address" text NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "counterparties_inn_unique" UNIQUE ("inn"),
    CONSTRAINT "counterparties_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "counterparties" ("id", "user_id", "inn", "name", "ogrn", "address", "created_at", "updated_at") VALUES
(1,	2,	'9731146883',	'ООО "РАПИД АР ЭНД ДИ"',	'1257700039574',	'121108, г Москва, р-н Фили-Давыдково, ул Герасима Курина, д 16, кв 353',	'2025-03-28 08:06:17',	'2025-03-28 08:06:17'),
(2,	2,	'1684024320',	'ООО "ТЕХНОЛОГИИ ТЕКСТИЛЯ"',	'1251600007460',	'420049, Респ Татарстан, г Казань, Приволжский р-н, ул Шаляпина, д 12, помещ 6',	'2025-03-28 08:07:36',	'2025-03-28 08:07:36'),
(3,	1,	'7802416550',	'ООО "АЙТИ-СИТИ"',	'1079847135510',	'195277, Г.САНКТ-ПЕТЕРБУРГ, ПР-КТ БОЛЬШОЙ САМПСОНИЕВСКИЙ, Д.28, ЛИТ.А, К.1, ПОМ.7Н, КОМ.6',	'2025-03-28 08:10:17',	'2025-03-28 08:10:17'),
(4,	1,	'7714426252',	'ООО "КАЙТЕН СОФТВЕР"',	'1187746341804',	'125252, г Москва, Хорошевский р-н, проезд Берёзовой Рощи, д 12, ком 55',	'2025-03-28 08:15:03',	'2025-03-28 08:15:03');




INSERT INTO "migrations" ("id", "migration", "batch") VALUES
(1,	'0001_01_01_000000_create_users_table',	1),
(2,	'0001_01_01_000001_create_cache_table',	1),
(3,	'0001_01_01_000002_create_jobs_table',	1),
(4,	'2025_03_27_183500_create_personal_access_tokens_table',	1),
(5,	'2025_03_27_184019_create_counterparties_table',	1);


INSERT INTO "personal_access_tokens" ("id", "tokenable_type", "tokenable_id", "name", "token", "abilities", "last_used_at", "expires_at", "created_at", "updated_at") VALUES
(1,	'App\Models\User',	1,	'auth_token',	'595e2da1f3b4298f00ae0aa40b61658c3f425541b0ad0b0dd2474222d78239c9',	'["*"]',	NULL,	NULL,	'2025-03-28 07:48:21',	'2025-03-28 07:48:21'),
(3,	'App\Models\User',	1,	'auth_token',	'80f4c51f13a13e62abfbfdd06381148ef537a5b507a9d7ad94a294de22435b5d',	'["*"]',	NULL,	NULL,	'2025-03-28 07:50:09',	'2025-03-28 07:50:09'),
(2,	'App\Models\User',	2,	'auth_token',	'f0c8fc6879a8b077465cd04be7d923574584fd68295faaa881ae0130f9d2766b',	'["*"]',	'2025-03-28 08:07:36',	NULL,	'2025-03-28 07:49:04',	'2025-03-28 08:07:36'),
(4,	'App\Models\User',	1,	'auth_token',	'fd9820edde74474a973fc3413f6c6cdcb1d4277629acde06b71975fb010685a6',	'["*"]',	'2025-03-28 08:13:13',	NULL,	'2025-03-28 08:08:10',	'2025-03-28 08:13:13'),
(5,	'App\Models\User',	1,	'auth_token',	'8416c0f3469bd972d0b533bf0b9c23c328ad1839e2211fc86e705f9a7ad5bee4',	'["*"]',	'2025-03-28 08:15:09',	NULL,	'2025-03-28 08:13:55',	'2025-03-28 08:15:09');

INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES
('B7d1zRoqZZBgdbHJOmYjX3gdeO8qjCXuwJxMaHM6',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0',	'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRk9DY0ZiSnZFTFB6bEtyWldUaWt0OThBOG1iTFdybUdoU3JOVzdWViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vY291bnRlcnBhcnR5LW1hbmFnZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',	1743147466);

INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at") VALUES
(1,	'Иван Иванов',	'user@example.com',	NULL,	'$2y$12$07MC0OOlOcRHveHRRFQwMuh6zs3MshO8pbjddfo.2Rvc2wRh7D51G',	NULL,	'2025-03-28 07:48:21',	'2025-03-28 07:48:21'),
(2,	'Иван Иванов1',	'user@exam1ple.com',	NULL,	'$2y$12$kvp26NK5L92xgDeTXE0gHuygU5S0K3A1n0UT7MnMA5ttPRXuLtAfO',	NULL,	'2025-03-28 07:49:04',	'2025-03-28 07:49:04');

ALTER TABLE ONLY "public"."counterparties" ADD CONSTRAINT "counterparties_user_id_foreign" FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE NOT DEFERRABLE;

-- 2025-03-28 11:15:55.025175+03
