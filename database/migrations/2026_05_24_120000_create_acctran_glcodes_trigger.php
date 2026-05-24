<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Drop existing triggers if present
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_acctran_before_insert_glcode`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_acctran_before_update_glcode`;');

        // BEFORE INSERT: ensure acctran.actype matches the account's actype (from accounts -> glcodes)
        DB::unprepared("CREATE TRIGGER `trg_acctran_before_insert_glcode`\n" .
            "BEFORE INSERT ON `acctran`\n" .
            "FOR EACH ROW\n" .
            "BEGIN\n" .
            "    DECLARE v_actype INT DEFAULT NULL;\n" .
            "    SELECT a.actype INTO v_actype FROM `accounts` a WHERE a.accountid = NEW.accountid LIMIT 1;\n" .
            "    IF v_actype IS NOT NULL THEN\n" .
            "        SET NEW.actype = v_actype;\n" .
            "    END IF;\n" .
            "END");

        // BEFORE UPDATE: keep acctran.actype in sync when accountid changes or on any update
        DB::unprepared("CREATE TRIGGER `trg_acctran_before_update_glcode`\n" .
            "BEFORE UPDATE ON `acctran`\n" .
            "FOR EACH ROW\n" .
            "BEGIN\n" .
            "    DECLARE v_actype INT DEFAULT NULL;\n" .
            "    SELECT a.actype INTO v_actype FROM `accounts` a WHERE a.accountid = NEW.accountid LIMIT 1;\n" .
            "    IF v_actype IS NOT NULL THEN\n" .
            "        SET NEW.actype = v_actype;\n" .
            "    END IF;\n" .
            "END");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_acctran_before_insert_glcode`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_acctran_before_update_glcode`;');
    }
};
