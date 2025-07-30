import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';

type RegisterForm = {
    name: string;
    email: string;
    countryCode: string;
    telefono: string;
    password: string;
    password_confirmation: string;
};

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm<Required<RegisterForm>>({
        name: '',
        email: '',
        countryCode: '+52',
        telefono: '',
        password: '',
        password_confirmation: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <AuthLayout title="Cree una cuenta" description="Ingrese sus datos a continuación para crear su cuenta">
            <Head title="Register" />
            <form className="flex flex-col gap-6" onSubmit={submit}>
                <div className="grid gap-6">
                    <div className="grid gap-2">
                        <Label htmlFor="name">Nombre</Label>
                        <Input
                            id="name"
                            type="text"
                            required
                            autoFocus
                            tabIndex={1}
                            autoComplete="name"
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                            disabled={processing}
                            placeholder="Nombre Completo"
                        />
                        <InputError message={errors.name} className="mt-2" />
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="email">Correo Electronico</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            tabIndex={2}
                            autoComplete="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            disabled={processing}
                            placeholder="email@ejemplo.com"
                        />
                        <InputError message={errors.email} />
                    </div>
                    
                    <div className="grid gap-2">
                        <Label htmlFor="telefono">Teléfono</Label>
                        <div className="flex items-start gap-2">
                            <div className="w-1/4">
                                <Input
                                    id="countryCode"
                                    type="text"
                                    required
                                    tabIndex={3}
                                    autoComplete="tel-country-code"
                                    value={data.countryCode}
                                    onChange={(e) => setData('countryCode', e.target.value)}
                                    disabled={processing}
                                    placeholder="+52"
                                />
                                <InputError message={errors.countryCode} className="mt-2" />
                            </div>
                            <div className="w-3/4">
                                <Input
                                    id="telefono"
                                    type="tel"
                                    required
                                    tabIndex={4}
                                    autoComplete="tel-national"
                                    value={data.telefono}
                                    onChange={(e) => setData('telefono', e.target.value)}
                                    disabled={processing}
                                    placeholder="10 dígitos"
                                    maxLength={10}
                                />
                                <InputError message={errors.telefono} className="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="password">Contraseña</Label>
                        <Input
                            id="password"
                            type="password"
                            required
                            tabIndex={3}
                            autoComplete="new-password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            disabled={processing}
                            placeholder="Contraseña"
                        />
                        <InputError message={errors.password} />
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="password_confirmation">Confirmar contraseña</Label>
                        <Input
                            id="password_confirmation"
                            type="password"
                            required
                            tabIndex={4}
                            autoComplete="new-password"
                            value={data.password_confirmation}
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                            disabled={processing}
                            placeholder="Repetir contraseña"
                        />
                        <InputError message={errors.password_confirmation} />
                    </div>

                    <Button type="submit" className="mt-2 w-full hover:bg-mktGreen transition-colors duration-300 ease-in-out" tabIndex={5} disabled={processing}>
                        {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                        Crear cuenta
                    </Button>
                </div>

                <div className="text-muted-foreground text-center text-sm">
                    ¿Ya tiene cuenta?{' -> '}
                    <TextLink href={route('login')} tabIndex={6}>
                        Log in
                    </TextLink>
                </div>
            </form>
        </AuthLayout>
    );
}
