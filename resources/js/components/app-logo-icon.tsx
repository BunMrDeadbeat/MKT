import { ImgHTMLAttributes } from 'react';
import logo from '@/images/favicon.png';
export default function AppLogoIcon(props: ImgHTMLAttributes<HTMLImageElement>) {
    return (
        <img src="/favicon.ico" alt="My Company Logo" className="h-8 w-auto" {...props} />
    ); 
}
