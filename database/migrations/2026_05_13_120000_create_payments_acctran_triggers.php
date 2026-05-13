<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Keeps `acctran` in sync with `payments` (double entry, vtype pymt).
 *
 * Notes vs legacy snippets:
 * - `acctran` has no `Id` column; rows match shifts-style `INSERT ... SET` with `actype` from `accounts`.
 * - `payments.transid` is AUTO_INCREMENT here — no MAX(transid)+1 in BEFORE INSERT (avoids races with AI).
 * - Payment business date is `NEW.date` (not NOW()) for the ledger `date` column.
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `payments_before_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `payments_after_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `payments_after_update`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `payments_after_delete`;');

        DB::unprepared("
            CREATE TRIGGER `payments_before_insert`
            BEFORE INSERT ON `payments`
            FOR EACH ROW
            BEGIN
                SET @__payments_bi_noop := 0;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `payments_after_insert`
            AFTER INSERT ON `payments`
            FOR EACH ROW
            BEGIN
                IF NEW.debitac IS NOT NULL AND NEW.creditac IS NOT NULL THEN
                    DELETE FROM `acctran`
                    WHERE `transid` = NEW.transid
                    AND `vtype` = 'pymt';

                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.transid,
                        `vtype` = 'pymt',
                        `user_id` = NEW.user_id,
                        `date` = NEW.date,
                        `accountid` = NEW.debitac,
                        `debit` = NEW.amount,
                        `credit` = 0,
                        `details` = IFNULL(NEW.details, ''),
                        `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = NEW.debitac LIMIT 1),
                        `created_at` = NOW(),
                        `updated_at` = NOW();

                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.transid,
                        `vtype` = 'pymt',
                        `user_id` = NEW.user_id,
                        `date` = NEW.date,
                        `accountid` = NEW.creditac,
                        `debit` = 0,
                        `credit` = NEW.amount,
                        `details` = IFNULL(NEW.details, ''),
                        `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = NEW.creditac LIMIT 1),
                        `created_at` = NOW(),
                        `updated_at` = NOW();
                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `payments_after_update`
            AFTER UPDATE ON `payments`
            FOR EACH ROW
            BEGIN
                DELETE FROM `acctran`
                WHERE `transid` = OLD.transid
                AND `vtype` = 'pymt';

                IF NEW.debitac IS NOT NULL AND NEW.creditac IS NOT NULL THEN
                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.transid,
                        `vtype` = 'pymt',
                        `user_id` = NEW.user_id,
                        `date` = NEW.date,
                        `accountid` = NEW.debitac,
                        `debit` = NEW.amount,
                        `credit` = 0,
                        `details` = IFNULL(NEW.details, ''),
                        `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = NEW.debitac LIMIT 1),
                        `created_at` = NOW(),
                        `updated_at` = NOW();

                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.transid,
                        `vtype` = 'pymt',
                        `user_id` = NEW.user_id,
                        `date` = NEW.date,
                        `accountid` = NEW.creditac,
                        `debit` = 0,
                        `credit` = NEW.amount,
                        `details` = IFNULL(NEW.details, ''),
                        `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = NEW.creditac LIMIT 1),
                        `created_at` = NOW(),
                        `updated_at` = NOW();
                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `payments_after_delete`
            AFTER DELETE ON `payments`
            FOR EACH ROW
            BEGIN
                DELETE FROM `acctran`
                WHERE `transid` = OLD.transid
                AND `vtype` = 'pymt';
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `payments_before_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `payments_after_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `payments_after_update`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `payments_after_delete`;');
    }
};
