<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_acctran_after_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_acctran_after_update`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_clock_afer_delete`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_clock_after_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_clock_after_update`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_clock_after_delete`;');

        DB::unprepared("
            CREATE TRIGGER `trg_shifts_acctran_after_insert`
            AFTER INSERT ON `shifts`
            FOR EACH ROW
            BEGIN
                DELETE FROM `acctran`
                WHERE `transid` = NEW.id
                AND `vtype` = 'SFT';

                INSERT INTO `acctran`
                SET
                    `transid` = NEW.id,
                    `vtype` = 'SFT',
                    `user_id` = NEW.user_id,
                    `date` = NEW.shift_date,
                    `accountid` = 3,
                    `debit` = NEW.user_rate * NEW.total_hours,
                    `credit` = 0,
                    `details` = 'Paying User',
                    `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = 3),
                    `created_at` = NOW(),
                    `updated_at` = NOW();

                IF NEW.client_id IS NOT NULL THEN

                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.id,
                        `vtype` = 'SFT',
                        `user_id` = NEW.user_id,
                        `date` = NEW.shift_date,
                        `accountid` = NEW.client_id,
                        `debit` = NEW.total_billed_client - (NEW.user_rate * NEW.total_hours),
                        `credit` = 0,
                        `details` = 'Profit / Client Difference',
                        `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = NEW.client_id),
                        `created_at` = NOW(),
                        `updated_at` = NOW();

                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.id,
                        `vtype` = 'SFT',
                        `user_id` = NEW.user_id,
                        `date` = NEW.shift_date,
                        `accountid` = NEW.client_id,
                        `debit` = 0,
                        `credit` = NEW.total_billed_client,
                        `details` = 'Client Billing',
                        `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = NEW.client_id),
                        `created_at` = NOW(),
                        `updated_at` = NOW();

                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `trg_shifts_acctran_after_update`
            AFTER UPDATE ON `shifts`
            FOR EACH ROW
            BEGIN
                DELETE FROM `acctran`
                WHERE `transid` = NEW.id
                AND `vtype` = 'SFT';

                INSERT INTO `acctran`
                SET
                    `transid` = NEW.id,
                    `vtype` = 'SFT',
                    `user_id` = NEW.user_id,
                    `date` = NEW.shift_date,
                    `accountid` = 3,
                    `debit` = NEW.user_rate * NEW.total_hours,
                    `credit` = 0,
                    `details` = 'Paying User',
                    `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = 3),
                    `created_at` = NOW(),
                    `updated_at` = NOW();

                IF NEW.client_id IS NOT NULL THEN

                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.id,
                        `vtype` = 'SFT',
                        `user_id` = NEW.user_id,
                        `date` = NEW.shift_date,
                        `accountid` = NEW.client_id,
                        `debit` = NEW.total_billed_client - (NEW.user_rate * NEW.total_hours),
                        `credit` = 0,
                        `details` = 'Profit / Client Difference',
                        `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = NEW.client_id),
                        `created_at` = NOW(),
                        `updated_at` = NOW();

                    INSERT INTO `acctran`
                    SET
                        `transid` = NEW.id,
                        `vtype` = 'SFT',
                        `user_id` = NEW.user_id,
                        `date` = NEW.shift_date,
                        `accountid` = NEW.client_id,
                        `debit` = 0,
                        `credit` = NEW.total_billed_client,
                        `details` = 'Client Billing',
                        `actype` = (SELECT `actype` FROM `accounts` WHERE `accountid` = NEW.client_id),
                        `created_at` = NOW(),
                        `updated_at` = NOW();

                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `trg_shifts_acctran_after_delete`
            AFTER DELETE ON `shifts`
            FOR EACH ROW
            BEGIN
                    DELETE FROM `acctran`
                    WHERE `transid` = OLD.id
                    AND `vtype` = 'SFT';
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `trg_shifts_clock_after_insert`
            AFTER INSERT ON `shifts_clock`
            FOR EACH ROW
            BEGIN
                DECLARE v_total_hours DECIMAL(10,2);

                SELECT IFNULL(SUM(TIMESTAMPDIFF(SECOND, clock_in_datetime, clock_out_datetime)) / 3600, 0)
                INTO v_total_hours
                FROM `shifts_clock`
                WHERE `shift_id` = NEW.shift_id
                AND `clock_out_datetime` IS NOT NULL;

                UPDATE `shifts`
                SET
                    `total_hours` = v_total_hours,
                    `total_pay_user` = v_total_hours * `user_rate`,
                    `total_billed_client` = v_total_hours * `client_rate`
                WHERE `id` = NEW.shift_id;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `trg_shifts_clock_after_update`
            AFTER UPDATE ON `shifts_clock`
            FOR EACH ROW
            BEGIN
                DECLARE v_total_hours DECIMAL(10,2);
                DECLARE v_old_total_hours DECIMAL(10,2);

                SELECT IFNULL(SUM(TIMESTAMPDIFF(SECOND, clock_in_datetime, clock_out_datetime)) / 3600, 0)
                INTO v_total_hours
                FROM `shifts_clock`
                WHERE `shift_id` = NEW.shift_id
                AND `clock_out_datetime` IS NOT NULL;

                UPDATE `shifts`
                SET
                    `total_hours` = v_total_hours,
                    `total_pay_user` = v_total_hours * `user_rate`,
                    `total_billed_client` = v_total_hours * `client_rate`
                WHERE `id` = NEW.shift_id;

                IF OLD.shift_id <> NEW.shift_id THEN

                    SELECT IFNULL(SUM(TIMESTAMPDIFF(SECOND, clock_in_datetime, clock_out_datetime)) / 3600, 0)
                    INTO v_old_total_hours
                    FROM `shifts_clock`
                    WHERE `shift_id` = OLD.shift_id
                    AND `clock_out_datetime` IS NOT NULL;

                    UPDATE `shifts`
                    SET
                        `total_hours` = v_old_total_hours,
                        `total_pay_user` = v_old_total_hours * `user_rate`,
                        `total_billed_client` = v_old_total_hours * `client_rate`
                    WHERE `id` = OLD.shift_id;

                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER `trg_shifts_clock_after_delete`
            AFTER DELETE ON `shifts_clock`
            FOR EACH ROW
            BEGIN
                DECLARE v_total_hours DECIMAL(10,2);

                SELECT IFNULL(SUM(TIMESTAMPDIFF(SECOND, clock_in_datetime, clock_out_datetime)) / 3600, 0)
                INTO v_total_hours
                FROM `shifts_clock`
                WHERE `shift_id` = OLD.shift_id
                AND `clock_out_datetime` IS NOT NULL;

                UPDATE `shifts`
                SET
                    `total_hours` = v_total_hours,
                    `total_pay_user` = v_total_hours * `user_rate`,
                    `total_billed_client` = v_total_hours * `client_rate`
                WHERE `id` = OLD.shift_id;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_acctran_after_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_acctran_after_update`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_clock_after_insert`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_clock_after_update`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_shifts_clock_after_delete`;');
    }
};