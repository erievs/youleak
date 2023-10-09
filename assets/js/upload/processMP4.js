document.addEventListener('DOMContentLoaded', () => {
    const { createWorker } = FFmpeg;
    const worker = createWorker({
        logger: m => console.log(m)
    });

    const inputFile = document.getElementById('file-input');
    const processButton = document.getElementById('process-button');
    const downloadLinkFLV = document.getElementById('download-link-flv');

    processButton.addEventListener('click', async () => {
        const file = inputFile.files[0];

        if (!file) {
            alert('Please select a file.');
            return;
        }

        const randomID = generateRandomFileName(12);

        const inputFileName = `${randomID}.m4v`;
        const outputFileNameMP4 = `${randomID}.mp4`;

        await worker.load();
        await worker.write(inputFileName, file);
        console.log('Write complete');

        await worker.run(`-i ${inputFileName} -c:v libx264 -b:v 1000k -an ${outputFileNameMP4}`);
        console.log('MP4 processing finished');

        const { data: mp4Data } = await worker.read(outputFileNameMP4);

        const mp4Blob = new Blob([mp4Data], { type: 'video/mp4' });

        downloadLinkFLV.href = URL.createObjectURL(mp4Blob);
        downloadLinkFLV.download = `${randomID}.mp4`;
        downloadLinkFLV.innerHTML = 'Download MP$';

        const formDataMP4 = new FormData();
        formDataMP4.append('mp4_video', mp4Blob, `${randomID}.mp4`);
        worker.terminate();
        fetch('http://localhost:8080/backend/upload.php', {
            method: 'POST',
            body: formDataMP4, 
        }).then(responseFLV => {
            if (responseFLV.ok) {
                console.log('Processed MP4 video sent to the server successfully.');
            } else {
                console.error('Error sending processed MP4 video to the server.');
            }
        });
    });

    function generateRandomFileName(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

});