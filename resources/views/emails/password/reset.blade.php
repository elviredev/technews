<x-mail::message>
# Réinitialisation du mot de passe

Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.

<x-mail::button :url="$url">
  Réinitialiser le mot de passe
</x-mail::button>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
