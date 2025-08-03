// Components
import { Head, useForm } from '@inertiajs/react';
import { Link, LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import AuthLayout from '@/layouts/auth-layout';

export default function VerifyEmail({ status }: { status?: string }) {
    const { post, processing } = useForm({});

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('verification.send'));
    };

    return (
        <AuthLayout title="Verificación de correo electrónico" description="Por favor verifique su dirección de correo electrónico haciendo clic en el enlace que enviamos por correo.">
            <Head title="Email verification" />

            {status === 'verification-link-sent' && (
                <div className="mb-4 text-center text-sm font-medium text-green-600">
                    Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro. No olvide revisar su carpeta de spam si no lo ve en su bandeja de entrada.
                </div>
            )}

            <form onSubmit={submit} className="space-y-6 text-center">
                <p className="text-sm text-gray-600">
                    ¿No recibió su correo electrónico?
                </p>
                <Button disabled={processing} variant="secondary">
                    {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                    Reenviar correo de verificación
                </Button>

                <TextLink href={route('home')} method="get" className="mx-auto block text-sm">
                     Volver
                </TextLink>
            </form>
        </AuthLayout>
    );
}
