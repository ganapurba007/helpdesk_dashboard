<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
  /**
   * Build the mail representation of the notification.
   */
  public function toMail($notifiable): MailMessage
  {
    $resetUrl = 'http://localhost:5173/reset_password?token=' . urlencode($this->token) . '&email=' . urlencode($notifiable->getEmailForPasswordReset());

    return (new MailMessage)
      ->subject('Reset Password Notification')
      ->line('You are receiving this email because we received a password reset request for your account.')
      ->action('Reset Password', $resetUrl)
      ->line('If you did not request a password reset, no further action is required.');
  }
}
