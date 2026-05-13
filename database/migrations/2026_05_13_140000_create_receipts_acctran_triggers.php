<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Syncs `acctran` with `receipts` (double entry, vtype rcpt).
 *
 * Adapted from legacy triggers: this schema has no `Id` on `acctran`; uses `actype` from `accounts`
 * and receipt `date` for the ledger row (not NOW()).
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `receipts_before_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `receipts_after_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `receipts_after_update`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `receipts_after_delete`;');

        DB::unprepared("
            CREATE TRIGGER `receipts_before_insert`
            BEFORE INSERT ON `receipts`
            FOR EACH ROW
            BEGIN
                SET @__receipts_bi_noop := 0;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `receipts_after_insert`
            AFTER INSERT ON `receipts`
            FOR EACH ROW
            BEGIN
                IF NEW.debitac IS NOT NULL AND NEW.creditac IS NOT NULL THEN
                    DELETE FROM `acctran`
                    WHERE `transid` = NEW.transid
                    AND `vtype` = 'rcpt';

                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.transid,
                        `vtype` = 'rcpt',
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
                        `vtype` = 'rcpt',
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
            CREATE TRIGGER `receipts_after_update`
            AFTER UPDATE ON `receipts`
            FOR EACH ROW
            BEGIN
                DELETE FROM `acctran`
                WHERE `transid` = OLD.transid
                AND `vtype` = 'rcpt';

                IF NEW.debitac IS NOT NULL AND NEW.creditac IS NOT NULL THEN
                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.transid,
                        `vtype` = 'rcpt',
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
                        `vtype` = 'rcpt',
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
            CREATE TRIGGER `receipts_after_delete`
            AFTER DELETE ON `receipts`
            FOR EACH ROW
            BEGIN
                DELETE FROM `acctran`
                WHERE `transid` = OLD.transid
                AND `vtype` = 'rcpt';
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `receipts_before_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `receipts_after_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `receipts_after_update`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `receipts_after_delete`;');
    }
};
