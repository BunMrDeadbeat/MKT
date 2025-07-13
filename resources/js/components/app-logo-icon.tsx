import { SVGAttributes } from 'react';
import logo from '@/images/favicon.png';
export default function AppLogoIcon(props: SVGAttributes<SVGElement>) {
    return (
        <img src="/favicon.ico" alt="My Company Logo" className="h-8 w-auto" ></img>
    ); 
}
