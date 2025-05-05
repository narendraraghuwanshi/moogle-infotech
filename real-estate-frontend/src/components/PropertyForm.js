import React, { useState } from 'react';
import {
    TextField,
    Select,
    MenuItem,
    Button,
    FormControl,
    InputLabel,
    Box,
    Typography,
} from '@mui/material';

const propertyTypes = ['house', 'department', 'land', 'commercial_ground'];

export default function PropertyForm({ onSubmit, property }) {
    const [formData, setFormData] = useState(property || {
        name: '',
        real_state_type: 'house',
        street: '',
        external_number: '',
        internal_number: '',
        neighborhood: '',
        city: '',
        country: '',
        rooms: '',
        bathrooms: '',
        comments: '',
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value,
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        onSubmit(formData);
    };

    return (
        <Box component="form" onSubmit={handleSubmit} sx={{ mt: 3 }}>
            <Typography variant="h6" gutterBottom>
                Property Details
            </Typography>
            
            <TextField
                fullWidth
                required
                label="Name"
                name="name"
                value={formData.name}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            <FormControl fullWidth sx={{ mb: 2 }}>
                <InputLabel>Property Type</InputLabel>
                <Select
                    required
                    label="Property Type"
                    name="real_state_type"
                    value={formData.real_state_type}
                    onChange={handleChange}
                >
                    {propertyTypes.map(type => (
                        <MenuItem key={type} value={type}>
                            {type.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}
                        </MenuItem>
                    ))}
                </Select>
            </FormControl>

            <TextField
                fullWidth
                required
                label="Street"
                name="street"
                value={formData.street}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            <TextField
                fullWidth
                required
                label="External Number"
                name="external_number"
                value={formData.external_number}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            {['department', 'commercial_ground'].includes(formData.real_state_type) && (
                <TextField
                    fullWidth
                    required
                    label="Internal Number"
                    name="internal_number"
                    value={formData.internal_number}
                    onChange={handleChange}
                    sx={{ mb: 2 }}
                />
            )}

            <TextField
                fullWidth
                required
                label="Neighborhood"
                name="neighborhood"
                value={formData.neighborhood}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            <TextField
                fullWidth
                required
                label="City"
                name="city"
                value={formData.city}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            <TextField
                fullWidth
                required
                label="Country (2 letters)"
                name="country"
                value={formData.country}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            <TextField
                fullWidth
                required
                type="number"
                label="Rooms"
                name="rooms"
                value={formData.rooms}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            <TextField
                fullWidth
                required
                type="number"
                step="0.5"
                label="Bathrooms"
                name="bathrooms"
                value={formData.bathrooms}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            <TextField
                fullWidth
                multiline
                maxRows={4}
                label="Comments"
                name="comments"
                value={formData.comments}
                onChange={handleChange}
                sx={{ mb: 2 }}
            />

            <Button
                type="submit"
                variant="contained"
                color="primary"
                sx={{ mt: 2 }}
            >
                Save Property
            </Button>
        </Box>
    );
}
