<form method="post" class="hmbkp-form" novalidate data-schedule-action="<?php if ( isset( $is_new_schedule ) ) { ?>add<?php } else { ?>edit<?php } ?>">

	<input type="hidden" name="hmbkp_schedule_id" value="<?php esc_attr_e( $schedule->get_id() ); ?>" />

	<fieldset class="hmbkp-edit-schedule-form">

		<legend><?php _e( 'Schedule Settings', 'hmbkp' ); ?></legend>

    	<label>

    		<?php _e( 'Backup', 'hmbkp' ); ?>

    		<select name="hmbkp_schedule_type" id="hmbkp_schedule_type">
    			<option<?php selected( $schedule->get_type(), 'complete' ); ?> value="complete"><?php _e( 'Both Database &amp; files', 'hmbkp' ); ?></option>
    			<option<?php selected( $schedule->get_type(), 'file' ); ?> value="file"><?php _e( 'Files only', 'hmbkp' ); ?></option>
    			<option<?php selected( $schedule->get_type(), 'database' ); ?> value="database"><?php _e( 'Database only', 'hmbkp' ); ?></option>
    		</select>

    	</label>

    	<label>

    		<?php _e( 'Schedule', 'hmbkp' ); ?>

    		<select name="hmbkp_schedule_reoccurrence" id="hmbkp_schedule_reoccurrence">

    			<option value="manually"><?php _e( 'Manual Only', 'hmbkp' ); ?></option>

                <?php foreach ( $schedule->get_cron_schedules() as $cron_schedule => $cron_details ) : ?>

                    <option<?php selected( $schedule->get_reoccurrence(), $cron_schedule ); ?> value="<?php esc_attr_e( $cron_schedule ); ?>"><?php esc_html_e( $cron_details['display'], 'hmbkp' ); ?></option>

                <?php endforeach; ?>

    		</select>

			</label>

		<label id="start-day" class="recurring-setting">

			<?php _e( 'Start Day', 'hmbkp' ); ?>

			<select id="hmbkp_schedule_start_day_of_week" name="recurrence[hmbkp_schedule_start_day_of_week]">

				<option>Monday</option>

				<option>Tuesday</option>

				<option>Wednesday</option>

				<option>Thursday</option>

				<option>Friday</option>

				<option>Saturday</option>

				<option>Sunday</option>

			</select>

		</label>

		<label id="start-date" class="recurring-setting">

			<?php _e( 'Start Day of month', 'hmbkp' ); ?>

			<input type="number" min="0" max="31" step="1" value="1" id="hmbkp_schedule_start_day_of_month" name="recurrence[hmbkp_schedule_start_day_of_month]">

		</label>

		<label id="schedule-start" class="recurring-setting">

			<?php _e( 'Start Time', 'hmbkp' ); ?>

			<input type="number" min="0" max="24" step="1" value="7" name="recurrence[hmbkp_schedule_start_hours]" id="hmbkp_schedule_start_hours"> Hours

			<input type="number" min="0" max="59" step="1" value="30" name="recurrence[hmbkp_schedule_start_minutes]" id="hmbkp_schedule_start_minutes"> Minutes

			<p class="description">If twice daily, second backup will fire 12 hours after set time.</p>
		</label>

		<label>

    		<?php _e( 'Number of backups to store on this server', 'hmbkp' ); ?>

    		<input type="number" name="recurrence[hmbkp_schedule_max_backups]" min="1" step="1" value="<?php esc_attr_e( $schedule->get_max_backups() ); ?>" />

            <p class="description"><?php printf( __( 'Past this limit older backups will be deleted automatically. This schedule will store a maximum of %s of backups', 'hmbkp' ), '<code>' . size_format( $schedule->get_filesize() * $schedule->get_max_backups() ) . '</code>' ); ?></p>

    	</label>

        <?php

				foreach ( HMBKP_Services::get_services( $schedule ) as $service )
					$service->field();

				?>

    	<p class="submit">

		    <button type="submit" class="button-primary"><?php _e( 'Update', 'hmbkp' ); ?></button>

		</p>

	</fieldset>

</form>