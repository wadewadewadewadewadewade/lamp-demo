import tscc from '@tscc/rollup-plugin-tscc';
import typescript from '@rollup/plugin-typescript';
import { terser } from 'rollup-plugin-terser';
//import sass from 'rollup-plugin-sass';
import scss from './index.es.js';

export default {
    output: {
        dir: 'build/'
    },
    plugins: [
        terser(),
        tscc(),
        typescript(),
        scss({
            include: './src/**/*.scss',
            output: './build/bundle.css'
        })
    ]
}